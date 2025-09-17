<?php

namespace App\Filament\Resources\PracticeEvaluations\Pages;

use App\Filament\Resources\PracticeEvaluations\PracticeEvaluationResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPracticeEvaluations extends ListRecords
{
    protected static string $resource = PracticeEvaluationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
