<?php

namespace App\Filament\Resources\Assesors\Pages;

use App\Models\User;
use Filament\Actions\DeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\Assesors\AssesorResource;

class EditAssesor extends EditRecord
{
    protected static string $resource = AssesorResource::class;

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $formData = $this->form->getState();
      
        
        $user = User::find($this->record->user_id);
        $user->update([ 
            'email' => $formData['email_assessor'],
        ]);
        // Update data user jika ada password baru
        if (isset($formData['password']) && !empty($formData['password'])) {
            $user->update([
                
                'password' => $formData['password'],
            ]);
        }

        return $formData;
    }
    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
          ForceDeleteAction::make(),
           RestoreAction::make(),
        ];
    }
}
