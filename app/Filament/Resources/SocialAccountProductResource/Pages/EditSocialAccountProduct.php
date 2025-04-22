<?php

namespace App\Filament\Resources\SocialAccountProductResource\Pages;

use App\Filament\Resources\SocialAccountProductResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSocialAccountProduct extends EditRecord
{
    protected static string $resource = SocialAccountProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
