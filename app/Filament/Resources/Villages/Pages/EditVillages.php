<?php

namespace App\Filament\Resources\Villages\Pages;

use App\Filament\Resources\Villages\VillagesResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditVillages extends EditRecord
{
    protected static string $resource = VillagesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
