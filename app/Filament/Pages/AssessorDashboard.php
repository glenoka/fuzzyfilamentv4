<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;
use Filament\Support\Icons\Heroicon;
use BackedEnum;

class AssessorDashboard extends Page
{
    protected string $view = 'filament.pages.assessor-dashboard';

protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-home';
    protected static ?string $title = 'Halaman Assessor';
      protected static ?string $navigationLabel = 'Home';

    protected static ?int $navigationSort = -2;

    use HasPageShield;
    public $user;
    // public function mount(){
    //     $this->user = Auth::user();
    //    $this->user ->assignRole('assessor');
    // }
    
}
