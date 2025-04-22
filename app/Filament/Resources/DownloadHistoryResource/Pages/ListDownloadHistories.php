<?php

namespace App\Filament\Resources\DownloadHistoryResource\Pages;

use App\Filament\Resources\DownloadHistoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDownloadHistories extends ListRecords
{
    protected static string $resource = DownloadHistoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
