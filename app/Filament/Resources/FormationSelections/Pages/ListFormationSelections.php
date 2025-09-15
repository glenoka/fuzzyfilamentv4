<?php

namespace App\Filament\Resources\FormationSelections\Pages;

use App\Filament\Resources\FormationSelections\FormationSelectionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListFormationSelections extends ListRecords
{
    protected static string $resource = FormationSelectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
