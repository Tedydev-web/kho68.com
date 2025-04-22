<?php

namespace App\Filament\Resources\DownloadHistoryResource\Pages;

use App\Filament\Resources\DownloadHistoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDownloadHistory extends EditRecord
{
    protected static string $resource = DownloadHistoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
