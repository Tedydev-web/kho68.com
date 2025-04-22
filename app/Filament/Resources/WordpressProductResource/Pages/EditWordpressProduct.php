<?php

namespace App\Filament\Resources\WordpressProductResource\Pages;

use App\Filament\Resources\WordpressProductResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWordpressProduct extends EditRecord
{
    protected static string $resource = WordpressProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
