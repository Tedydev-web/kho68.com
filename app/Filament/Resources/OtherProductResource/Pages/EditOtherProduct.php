<?php

namespace App\Filament\Resources\OtherProductResource\Pages;

use App\Filament\Resources\OtherProductResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditOtherProduct extends EditRecord
{
    protected static string $resource = OtherProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
