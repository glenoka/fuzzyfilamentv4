<?php

namespace App\Filament\Resources\Villages\Pages;

use App\Filament\Resources\Villages\VillagesResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListVillages extends ListRecords
{
    protected static string $resource = VillagesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Tambah Desa'),
        ];
    }
}
