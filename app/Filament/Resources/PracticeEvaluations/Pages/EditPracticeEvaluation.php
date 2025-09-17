<?php

namespace App\Filament\Resources\PracticeEvaluations\Pages;

use App\Filament\Resources\PracticeEvaluations\PracticeEvaluationResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPracticeEvaluation extends EditRecord
{
    protected static string $resource = PracticeEvaluationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
