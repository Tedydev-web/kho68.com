<?php

namespace App\Filament\Resources\OtherProductResource\Pages;

use App\Filament\Resources\DashboardResource\Widgets\OtherProductStatsOverview;
use App\Filament\Resources\OtherProductResource;
use App\Models\Category;
use App\Models\OtherProduct;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class ListOtherProducts extends ListRecords
{
    protected static string $resource = OtherProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            \EightyNine\ExcelImport\ExcelImportAction::make()
            ->processCollectionUsing(function (string $modelClass, Collection $collection) {
          // Mảng để lưu trữ thông tin sản phẩm
         $productsData = [];

            foreach ($collection as $row) {
              // Lấy danh mục từ tên
            $category = Category::where('name', $row['category'])->first();
            $categoryId = $category ? $category->id : null;

              // Gộp thông tin sản phẩm vào mảng
              if (!isset($productsData[$row['id']])) {
                $thumbnail = $row['thumbnail'];
                  if (!empty($thumbnail) && filter_var($thumbnail, FILTER_VALIDATE_URL)) {
                    // Tải ảnh từ URL
                    $imageData = file_get_contents($thumbnail);
                    // Kiểm tra xem dữ liệu đã được tải thành công
                    if ($imageData !== false) {
                        $fileName = basename($thumbnail); // Lấy tên tệp từ URL

                        // Lưu vào thư mục Social
                        Storage::disk(name: 'public')->put('Social/' . $fileName, $imageData);

                        // Cập nhật thumbnail với đường dẫn lưu trữ
                        $thumbnail = 'Social/' . $fileName;
                    } else {
                        // Xử lý lỗi nếu không tải được ảnh
                    }
                }
                // Thêm thông tin sản phẩm vào mảng
                $productsData[$row['id']] = [
                    'name' => $row['name'],
                    'slug' => $row['slug'],
                    'thumbnail' => $thumbnail,
                    'stock' => $row['stock'],
                    'sold_quantity' => $row['sold_quantity'],
                    'price' => $row['price'],
                    'description' => $row['description'],
                    'demo_link' => $row['demo_link'],
                    'download_link' => $row['download_link'],
                    'category_id' => $categoryId,
                    'system_requirements' => $row['system_requirements'],
                    'status' => $row['status'],
                    'additional_data' => $row['additional_data'],
                ];
            }
                  }

        // Tạo sản phẩm
         foreach ($productsData as $productData) {
             OtherProduct::create($productData);
        }
    }),

        ];
    }
    protected function getHeaderWidgets(): array
    {
        return [
            OtherProductStatsOverview::class,

        ];
    }
}
