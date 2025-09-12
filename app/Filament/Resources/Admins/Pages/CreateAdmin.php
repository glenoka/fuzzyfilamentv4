<?php

namespace App\Filament\Resources\Admins\Pages;

use App\Models\User;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\Admins\AdminResource;

class CreateAdmin extends CreateRecord
{
    protected static string $resource = AdminResource::class;
     protected function mutateFormDataBeforeCreate(array $data): array
    {
        $formData = $this->form->getState();

       $saveUser=User::create([
            'name' => $formData['name'],
            'username' => $formData['username'],
            'email' => $formData['email'],
            'password' => $formData['password'],
        ]);

        $formData['user_id'] = $saveUser->id;
        //$saveUser->assignRole('admin');

    return $formData;
    }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
