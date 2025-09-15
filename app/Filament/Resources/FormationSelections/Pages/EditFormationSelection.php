<?php

namespace App\Filament\Resources\FormationSelections\Pages;

use App\Filament\Resources\FormationSelections\FormationSelectionResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditFormationSelection extends EditRecord
{
    protected static string $resource = FormationSelectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
