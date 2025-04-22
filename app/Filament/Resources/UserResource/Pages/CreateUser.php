<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Models\UserDetail;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    protected function afterCreate()
    {
        // dd($this->data["userDetail"]);
        UserDetail::create([
            'user_id' => $this->record->id,
            'phone' => $this->data['userDetail']['phone'],
            'username' => $this->data['userDetail']['username'],
            'fullname' => $this->data['userDetail']['fullname'],
            // 'role' => $this->data['role'],
        ]);
    }
}
