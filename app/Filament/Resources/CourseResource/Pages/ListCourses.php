<?php

namespace App\Filament\Resources\CourseResource\Pages;

use App\Filament\Resources\CourseResource;
use App\Filament\Resources\DashboardResource\Widgets\CourseStatsOverview;
use App\Models\Category;
use App\Models\Course;
use App\Models\CourseModule;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class ListCourses extends ListRecords
{
    protected static string $resource = CourseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            \EightyNine\ExcelImport\ExcelImportAction::make()
    ->processCollectionUsing(function (string $modelClass, Collection $collection) {
        // Mảng để lưu trữ thông tin khóa học và module
        $coursesData = [];

        foreach ($collection as $row) {
            // Tìm kiếm hoặc tạo mới danh mục dựa trên tên danh mục
            $category = Category::where('name', $row['category'])->first();
            $categoryId = $category ? $category->id : null;

            // Gộp thông tin khóa học vào mảng
            if (!isset($coursesData[$row['course_title']])) {
                $image = $row['course_image'];
                if (!empty($image) && filter_var($image, FILTER_VALIDATE_URL)) {
                    // Tải ảnh từ URL
                    // $imageData = file_get_contents($image);

                    // if ($imageData !== false) {
                    //     $fileName = basename($image);
                    //     // Lưu vào thư mục Courses
                    //     Storage::disk(name: 'public')->put('Courses/' . $fileName, $imageData);
                    //     // Cập nhật đường dẫn image
                    //     $image = 'Courses/' . $fileName;
                    // }
                }

                $coursesData[$row['course_title']] = [
                    'category_id' => $categoryId,
                    'title' => $row['course_title'],
                    'slug' => $row['course_slug'],
                    'short_description' => $row['short_description'],
                    'long_description' => $row['long_description'],
                    'price' => $row['course_price'],
                    'sale_price' => $row['sale_price'],
                    'image' => $image,
                    'instructor' => $row['instructor'],
                    'duration' => $row['duration'],
                    'level' => $row['level'],
                    'video_count' => $row['video_count'],
                    'download_link' => $row['download_link'],
                    'video_url' => $row['video_url'],
                    'views' => $row['views'],
                    'status' => $row['status'],
                    'modules' => [] // Mảng để lưu trữ module
                ];
            }

            // Thêm module vào khóa học
            if ( !empty($row['course_title'])) {
                $coursesData[$row['course_title']]['modules'][] = [
                    'title' => $row['module_title'],
                    'content' => $row['module_content'],
                    'video_url' => $row['module_video_url'],
                    'video_count' => $row['module_video_count'],
                    'download_link' => $row['module_download_link'],
                    'order' => $row['module_order'],
                ];
            }
        }

        // Tạo khóa học và các module
        foreach ($coursesData as $courseData) {
            // Tạo khóa học
            $course = Course::create($courseData);

            // Tạo các module cho khóa học
            foreach ($courseData['modules'] as $moduleData) {
                CourseModule::create([
                    'course_id' => $course->id,
                    'title' => $moduleData['title'],
                    'content' => $moduleData['content'],
                    'video_url' => $moduleData['video_url'],
                    'video_count' => $moduleData['video_count'],
                    'download_link' => $moduleData['download_link'],
                    'order' => $moduleData['order'],
                ]);
            }
        }
    })

        ];
    }
    protected function getHeaderWidgets(): array
    {
        return [
            CourseStatsOverview::class,
        ];
    }
}
