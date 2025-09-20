<?php

namespace App\Filament\Resources\Exams\Pages;

use App\Models\Exam;
use Filament\Resources\Pages\Page;
use App\Filament\Resources\Exams\ExamsResource;

class Tryout extends Page
{
    protected static string $resource = ExamsResource::class;

    protected string $view = 'filament.resources.exams.pages.tryout';
    
    public ?Exam $record = null;

}
