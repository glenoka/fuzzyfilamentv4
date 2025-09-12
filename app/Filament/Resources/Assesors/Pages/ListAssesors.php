<?php

namespace App\Filament\Resources\Assesors\Pages;

use App\Filament\Resources\Assesors\AssesorResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAssesors extends ListRecords
{
    protected static string $resource = AssesorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
