<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use ZipArchive;

class GoogleDriveController extends Controller
{
    public function token()  {
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
    public function showUploadForm()
    {
        return view(view: 'upload'); // Chỉ định view sẽ hiển thị form upload
    }

    public function uploadFile(Request $request)
{
    try {

        $accessToken = $this->token();

        $name = Str::slug($request->file->getClientOriginalName());
        $mime = $request->file->getClientMimeType();

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $accessToken,
            'Content-Type' => 'application/json',
        ])->post('https://www.googleapis.com/drive/v3/files', [
            'data' => $name,
            'mimeType' => $mime,
            'uploadType' => 'resumable',
        ]);
        if ($response->successful()) {
            return $response;
        } else {
            return response('Failed to Upload to Google Drive');
        }
    } catch (\Exception $e) {
        dd($e);
        // In ra thông báo lỗi
        return response()->json([
            'error' => 'Upload failed: ' . $e->getMessage()
        ], 500);
    }
}

public function downloadFile()
{
    try {
        $accessToken = $this->token();
        $fileId = "19jh7Y4v33epv8RspeF2LlmaBNOW0X8KN";
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $accessToken,
        ])->get("https://www.googleapis.com/drive/v3/files/{$fileId}?alt=media");

        if ($response->successful()) {
            // Lấy thông tin file từ Google Drive
            $fileInfoResponse = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
            ])->get("https://www.googleapis.com/drive/v3/files/{$fileId}");

            if ($fileInfoResponse->successful()) {
                $fileInfo = $fileInfoResponse->json();
                $originalFileName = $fileInfo['name'];
                $fileExtension = pathinfo($originalFileName, PATHINFO_EXTENSION);

                // Tạo tệp tạm thời để lưu file
                $tempFilePath = tempnam(sys_get_temp_dir(), 'file_') . '.' . $fileExtension;
                file_put_contents($tempFilePath, $response->body());

                // Tạo tệp ZIP
                $zipFilePath = tempnam(sys_get_temp_dir(), 'file_') . '.zip';
                $zip = new ZipArchive();

                if ($zip->open($zipFilePath, ZipArchive::CREATE) === TRUE) {
                    $zip->addFile($tempFilePath, basename($tempFilePath));
                    $zip->close();
                } else {
                    throw new \Exception('Could not create ZIP file.');
                }

                // Xóa tệp tạm thời
                unlink($tempFilePath);

                // Gửi tệp ZIP cho người dùng tải xuống
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



}
