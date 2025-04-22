<?php

namespace App\Filament\Resources\SocialAccountProductResource\Pages;

use App\Filament\Resources\SocialAccountProductResource;
use App\Models\Category;
use App\Models\SocialAccountProduct;
use App\Models\SocialAccountProductAttribute;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class ListSocialAccountProducts extends ListRecords
{
    protected static string $resource = SocialAccountProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            \EightyNine\ExcelImport\ExcelImportAction::make()
                ->processCollectionUsing(function (string $modelClass, Collection $collection) {
                    // Mảng để lưu trữ thông tin sản phẩm và thuộc tính
                    $productsData = [];

                    foreach ($collection as $row) {
                        $category = Category::where('name', $row['category'])->first();
                        $categoryId = $category ? $category->id : null;
                        // Gộp thông tin sản phẩm vào mảng
                        if (!isset($productsData[$row['social_product_id']])) {
                            $thumbnail = $row['thumbnail'];
                            if (!empty($thumbnail) && filter_var($thumbnail, FILTER_VALIDATE_URL)) {
                                // Tải ảnh từ URL
                                $imageData = file_get_contents($thumbnail);
                                // Kiểm tra xem dữ liệu đã được tải thành công
                                if ($imageData !== false) {
                                    $fileName = basename($thumbnail); // Lấy tên tệp từ URL
                                    dd($fileName);

                                    // Lưu vào thư mục Social
                                    Storage::disk(name: 'public')->put('Social/' . $fileName, $imageData);

                                    // Cập nhật thumbnail với đường dẫn lưu trữ
                                    $thumbnail = 'Social/' . $fileName;
                                } else {
                                    // Xử lý lỗi nếu không tải được ảnh
                                    // Có thể hiển thị thông báo lỗi hoặc ghi log
                                }
                            }
                            $productsData[$row['social_product_id']] = [
                                'name' => $row['name'],
                                'slug' => $row['slug'],
                                'thumbnail' => $row['thumbnail'],
                                'stock' => $row['stock'],
                                'sold' => $row['sold'],
                                'country' => $row['country'],
                                'price' => $row['price'],
                                'short_content' => $row['short_content'],
                                'long_content' => $row['long_content'],
                                'data_account' => $row['account_data'],
                                'category_id' => $categoryId,
                                'attributes' => [] // Mảng để lưu trữ thuộc tính
                            ];
                        }

                        // Thêm thuộc tính vào mảng thuộc tính
                        if (!empty($row['attribute_name'])) {
                            $productsData[$row['social_product_id']]['attributes'][] = [
                                'attribute_name' => $row['attribute_name'],
                                'account_data' => $row['account_data'],
                                'status' => $row['status'],
                                'quantity' => $row['quantity'],
                                'additional_price' => $row['additional_price'],
                            ];
                        }
                    }
                    // Tạo sản phẩm và thuộc tính
                    foreach ($productsData as $productId => $productData) {
                        // Tạo sản phẩm
                        $product = SocialAccountProduct::create($productData);

                        // Tạo các thuộc tính cho sản phẩm
                        foreach ($productData['attributes'] as $attributeData) {
                            SocialAccountProductAttribute::create([
                                'social_product_id' => $product->id,
                                'attribute_name' => $attributeData['attribute_name'],
                                'account_data' => $attributeData['account_data'],
                                'status' => $attributeData['status'],
                                'quantity' => $attributeData['quantity'],
                                'additional_price' => $attributeData['additional_price'],
                            ]);
                        }
                    }
                })


        ];
    }
}
