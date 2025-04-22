<?php

namespace App\Filament\Resources\WordpressProductResource\Pages;

use App\Filament\Resources\WordpressProductResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use App\Models\WordpressProduct;

class CreateWordpressProduct extends CreateRecord
{
    protected static string $resource = WordpressProductResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Kiểm tra trùng lặp SKU
        $skuExists = WordpressProduct::where('sku', $data['sku'])->exists();
        if ($skuExists) {
            throw new \Exception('SKU already exists. Please choose a different one.');
        }

        return $data;
    }

}
