<?php

namespace App\Filament\Resources\Assesors\Pages;

use App\Models\User;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\Assesors\AssesorResource;

class CreateAssesor extends CreateRecord
{
    protected static string $resource = AssesorResource::class;
     protected function mutateFormDataBeforeCreate(array $data): array
    {
        $formData = $this->form->getState();

       $saveUser=User::create([
            'name' => $formData['name'],
            'username' => $formData['username'],
            'email' => $formData['email_assessor'],
            'password' => $formData['password'],
        ]);

        $formData['user_id'] = $saveUser->id;
        $saveUser->assignRole('assessor');

    return $formData;
    }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
