<?php

namespace App\Filament\Resources\MailSettingResource\Pages;

use App\Filament\Resources\MailSettingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMailSetting extends EditRecord
{
    protected static string $resource = MailSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
