<?php

namespace App\Filament\Resources\WordpressProductResource\Pages;

use App\Filament\Resources\WordpressProductResource;
use App\Models\Category;
use App\Models\WordpressProduct;
use Carbon\Carbon;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Collection;

class ListWordpressProducts extends ListRecords
{
    protected static string $resource = WordpressProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            \EightyNine\ExcelImport\ExcelImportAction::make()
            ->processCollectionUsing(function (string $modelClass, Collection $collection) {
                foreach ($collection as $row) {
                    $category = Category::where('id', $row['category_id'])->first();
                    $categoryId = $category ? $category->id : null;

                    // Handle gallery field (convert string to array if needed)
                    $gallery = is_string($row['gallery']) ? json_decode($row['gallery'], true) : [];

                    // Convert Excel serial date to valid Y-m-d format for license_expiration_date
                    $licenseExpirationDate = $row['license_expiration_date'];
                    if (is_numeric($licenseExpirationDate)) {
                        // Convert Excel serial date to Carbon date (Excel starts counting from 1900-01-01)
                        $licenseExpirationDate = Carbon::createFromFormat('Y-m-d', '1900-01-01')
                            ->addDays($licenseExpirationDate - 2) // Adjust for Excel's leap year bug
                            ->format('Y-m-d');
                    }

                    // Create or update product based on data
                    WordpressProduct::updateOrCreate(
                        ['slug' => $row['slug']],
                        [
                            'category_id' => $categoryId,
                            'name' => $row['name'],
                            'slug' => $row['slug'],
                            'image' => $row['image'],
                            'gallery' => $gallery,
                            'sku' => $row['sku'],
                            'type' => $row['type'],
                            'status' => $row['status'],
                            'version' => $row['version'],
                            'short_content' => $row['short_content'],
                            'long_content' => $row['long_content'],
                            'price' => $row['price'],
                            'sale_price' => $row['sale_price'],
                            'sold' => $row['sold'],
                            'demo' => $row['demo'],
                            'download_link' => $row['download_link'],
                            'system_requirements' => $row['system_requirements'],
                            'license_key' => $row['license_key'],
                            'license_expiration_date' => $licenseExpirationDate, // Use converted date
                            'views' => $row['views'],
                        ]
                    );
                }
            })

        ];
    }
}
