<?php

namespace App\Livewire;

use App\Models\DownloadHistory;
use Livewire\Component;
use App\Models\OtherProduct;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use ZipArchive;

class OtherProductOrderDetail extends Component
{
    public $orderId;
    public $otherProduct;
    public $isDownloading = false; // Thêm biến trạng thái

    public function mount($id)
    {
        $this->orderId = $id;
        $this->otherProduct = OtherProduct::findOrFail($id);
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

        return json_decode((string) $response->getBody(), true)['access_token'];
    }

    public function downloadFile()
    {
        $this->isDownloading = true;
        $this->dispatch('startDownload');

        try {
            $downloadLimit = \App\Models\WebsiteSetting::first()->download_limit; // Số lần tải tối đa
            $timeframeHours = \App\Models\WebsiteSetting::first()->timeframe_hours; // Thời gian giới hạn (giờ)

            $downloadsCount = DownloadHistory::where('user_id', auth()->id())
                ->where('file_id', $this->otherProduct->download_link)
                ->where('created_at', '>=', now()->subHours($timeframeHours))
                ->count();

            if ($downloadsCount >= $downloadLimit) {
                session()->flash('error', 'Bạn đã vượt quá số lần tải, vui lòng đợi trong khoảng thời gian để tải tiếp.');
                return; // Dừng tải nếu vượt quá giới hạn
            }

            $accessToken = $this->token();
            $fileId = $this->otherProduct->download_link;

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

                    // Tạo file zip
                    $zipFilePath = tempnam(sys_get_temp_dir(), 'file_') . '.zip';
                    $zip = new ZipArchive();

                    if ($zip->open($zipFilePath, ZipArchive::CREATE) === TRUE) {
                        $zip->addFile($tempFilePath, basename($tempFilePath));
                        $zip->close();
                    } else {
                        throw new \Exception('Could not create ZIP file.');
                    }

                    DownloadHistory::create([
                        'user_id' => auth()->id(),
                        'file_id' => $fileId,
                        'downloaded_at' => now(),
                        'ip_address' => request()->ip(),
                    ]);

                    unlink($tempFilePath);
                    $this->dispatch('downloadComplete');

                    return response()->download($zipFilePath)->deleteFileAfterSend(true);
                }
            }
        } catch (\Exception $e) {
            session()->flash('error', 'Tải xuống thất bại: ' . $e->getMessage());
        } finally {
            $this->isDownloading = false;
        }
    }
    public function render()
    {
        return view('livewire.other-product-order-detail', [
            'otherProduct' => $this->otherProduct,
        ]);
    }
}
