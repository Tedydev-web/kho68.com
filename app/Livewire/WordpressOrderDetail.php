<?php

namespace App\Livewire;

use App\Models\DownloadHistory;
use Livewire\Component;
use App\Models\WordpressProduct;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use ZipArchive;

class WordpressOrderDetail extends Component
{
    public $productId;
    public $product;
    public $isDownloading = false; // Thêm biến trạng thái

    public function mount($id)
    {
        $this->productId = $id;
        $this->product = WordpressProduct::findOrFail($id);
    }

    public function token()
    {
        // Lấy token Google API
        $client_id = Config::get('services.google.client_id');
        $client_secret = Config::get('services.google.client_secret');
        $refresh_token = Config::get('services.google.refresh_token');

        $response = Http::post('https://oauth2.googleapis.com/token', [
            'client_id' => $client_id,
            'client_secret' => $client_secret,
            'refresh_token' => $refresh_token,
            'grant_type' => 'refresh_token',
        ]);

        $accessToken = json_decode((string) $response->getBody(), true)['access_token'];
        return $accessToken;
    }

    public function downloadFile()
    {
        $this->isDownloading = true; // Khi bắt đầu tải, đặt trạng thái "Đang tải"
        $this->dispatch('startDownload'); // Gửi sự kiện tới JS

        try {
            $downloadLimit = \App\Models\WebsiteSetting::first()->download_limit;
            $timeframeHours = \App\Models\WebsiteSetting::first()->timeframe_hours;

            $downloadsCount = DownloadHistory::where('user_id', auth()->id())
                ->where('file_id', $this->product->download_link)
                ->where('created_at', '>=', now()->subHours($timeframeHours))
                ->count();

            if ($downloadsCount >= $downloadLimit) {
                session()->flash('error', 'Bạn đã vượt quá số lần tải, vui lòng đợi trong khoảng thời gian để tải tiếp.');
                return; // Dừng tải nếu vượt quá giới hạn
            }

            $product = WordpressProduct::findOrFail($this->productId);
            $accessToken = $this->token();
            $fileId = $product->download_link;

            // Tải file từ Google Drive
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
            ])->get("https://www.googleapis.com/drive/v3/files/{$fileId}?alt=media");

            if ($response->successful()) {
                $fileInfoResponse = Http::withHeaders([
                    'Authorization' => 'Bearer ' . $accessToken,
                ])->get("https://www.googleapis.com/drive/v3/files/{$fileId}");

                if ($fileInfoResponse->successful()) {
                    $fileInfo = $fileInfoResponse->json();
                    $originalFileName = $fileInfo['name'];
                    $fileExtension = pathinfo($originalFileName, PATHINFO_EXTENSION);

                    $tempFilePath = tempnam(sys_get_temp_dir(), 'file_') . '.' . $fileExtension;
                    file_put_contents($tempFilePath, $response->body());

                    $zipFilePath = tempnam(sys_get_temp_dir(), 'file_') . '.zip';
                    $zip = new ZipArchive();

                    if ($zip->open($zipFilePath, ZipArchive::CREATE) === TRUE) {
                        $zip->addFile($tempFilePath, basename($tempFilePath));
                        $zip->close();
                    } else {
                        throw new \Exception('Could not create ZIP file.');
                    }
                        DownloadHistory::create([
                        'user_id' => auth()->id(), // ID của người dùng hiện tại
                        'file_id' => $fileId, // ID file từ download_link
                        'downloaded_at' => now(), // Thời gian tải
                        'ip_address' => request()->ip(), // Địa chỉ IP
                    ]);
                    unlink(filename: $tempFilePath);
                    $this->dispatch('downloadComplete'); // Gửi sự kiện hoàn tất tải

                    return response()->download($zipFilePath)->deleteFileAfterSend(true);
                }
            }
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Download failed: ' . $e->getMessage()
            ], 500);
        } finally {
            $this->isDownloading = false; // Trả trạng thái về bình thường sau khi hoàn thành
        }
    }

    public function render()
    {
        return view('livewire.wordpress-order-detail', [
            'product' => $this->product,
        ]);
    }
}
