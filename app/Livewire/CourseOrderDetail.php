<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Course;
use App\Models\CourseModule;
use App\Models\DownloadHistory;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use ZipArchive;

class CourseOrderDetail extends Component
{
    public $orderId;
    public $course;
    public $modules;

    public function mount($id)
    {
        // Lấy thông tin khóa học và các modules dựa trên ID đơn hàng (khóa học)
        $this->orderId = $id;
        $this->course = Course::with('modules')->findOrFail($id);
        $this->modules = $this->course->modules;
    }

    public function token()
    {
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

    public function downloadFile($moduleId)
{
    try {
        // Fetch the module using the provided module ID
        $module = CourseModule::findOrFail($moduleId);

        // Lấy giới hạn tải và khoảng thời gian từ cài đặt website
        $websiteSetting = \App\Models\WebsiteSetting::first();
        $downloadLimit = $websiteSetting->download_limit; // Số lần tải tối đa
        $timeframeHours = $websiteSetting->timeframe_hours; // Thời gian giới hạn (giờ)

        // Kiểm tra số lần tải trong khoảng thời gian quy định
        $downloadsCount = DownloadHistory::where('user_id', auth()->id())
            ->where('file_id', $module->download_link) // Sử dụng download link làm file ID
            ->where('created_at', '>=', now()->subHours($timeframeHours))
            ->count();

        if ($downloadsCount >= $downloadLimit) {
            // Nếu vượt quá giới hạn tải, thông báo cho người dùng
            session()->flash('error', 'Bạn đã vượt quá số lần tải, vui lòng đợi trong khoảng thời gian để tải tiếp.');
            return; // Dừng tải nếu vượt quá giới hạn
        }

        $accessToken = $this->token();
        $fileId = $module->download_link;

        // Download the file from Google Drive
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $accessToken,
        ])->get("https://www.googleapis.com/drive/v3/files/{$fileId}?alt=media");

        if ($response->successful()) {
            // Get file information from Google Drive
            $fileInfoResponse = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
            ])->get("https://www.googleapis.com/drive/v3/files/{$fileId}");

            if ($fileInfoResponse->successful()) {
                $fileInfo = $fileInfoResponse->json();
                $originalFileName = $fileInfo['name'];
                $fileExtension = pathinfo($originalFileName, PATHINFO_EXTENSION);

                // Create a temporary file to store the downloaded content
                $tempFilePath = tempnam(sys_get_temp_dir(), 'file_') . '.' . $fileExtension;
                file_put_contents($tempFilePath, $response->body());

                // Create a ZIP file
                $zipFilePath = tempnam(sys_get_temp_dir(), 'file_') . '.zip';
                $zip = new ZipArchive();

                if ($zip->open($zipFilePath, ZipArchive::CREATE) === TRUE) {
                    $zip->addFile($tempFilePath, basename($tempFilePath));
                    $zip->close();
                } else {
                    throw new \Exception('Could not create ZIP file.');
                }

                // Lưu lịch sử tải
                DownloadHistory::create([
                    'user_id' => auth()->id(),
                    'file_id' => $fileId,
                    'downloaded_at' => now(),
                    'ip_address' => request()->ip(),
                ]);

                // Delete the temporary file
                unlink($tempFilePath);

                // Send the ZIP file for download
                return response()->download($zipFilePath)->deleteFileAfterSend(true);
            } else {
                return response('Failed to retrieve file info from Google Drive', $fileInfoResponse->status());
            }
        } else {
            return response('Failed to Download from Google Drive', $response->status());
        }
    } catch (\Exception $e) {
        return response()->json([
            'error' => 'Download failed: ' . $e->getMessage()
        ], 500);
    }
}



    public function render()
    {
        return view('livewire.course-order-detail', [
            'course' => $this->course,
            'modules' => $this->modules,
        ]);
    }
}
