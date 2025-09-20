<?php

namespace App\Filament\Resources\Exams\Pages;

use Filament\Actions\CreateAction;
use Illuminate\Support\Facades\Auth;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\Exams\ExamsResource;

class ListExams extends ListRecords
{
    protected static string $resource = ExamsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
             ->visible(fn () => Auth::user()->hasRole('super_admin')),
        ];
    }
}
