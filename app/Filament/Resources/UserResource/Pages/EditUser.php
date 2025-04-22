<?php

    namespace App\Filament\Resources\UserResource\Pages;

    use App\Filament\Resources\UserResource;
    use App\Models\UserDetail;
    use Filament\Actions;
    use Filament\Resources\Pages\EditRecord;

    class EditUser extends EditRecord
    {
        protected static string $resource = UserResource::class;

        protected function getHeaderActions(): array
        {
            return [
                Actions\DeleteAction::make(),
            ];
        }

        protected function beforeSave()
        {
            if ($this->record->userDetail) {
                $this->record->userDetail->update([
                    'phone' => $this->data['userDetail']['phone'],
                    'fullname' => $this->data['userDetail']['fullname'],
                    'username' => $this->data['userDetail']['username'],
                    // 'role' => $this->data['role'],
                ]);
            } else {
                UserDetail::create(attributes: [
                    'user_id' => $this->record->id,
                    'phone' => $this->data['phone'],
                    'fullname' => $this->data['userDetail']['fullname'],
                    'username' => $this->data['userDetail']['username'],

                    // 'role' => $this->data['role'],
                ]);
            }
        }
    }
