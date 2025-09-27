<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;

class AssessorDashboard extends Page
{
    protected string $view = 'filament.pages.assessor-dashboard';
    protected static ?string $title = 'Dashboard Assessor';
    protected static ?int $navigationSort = -2;

    use HasPageShield;
    public $user;
    // public function mount(){
    //     $this->user = Auth::user();
    //    $this->user ->assignRole('assessor');
    // }
    
}
