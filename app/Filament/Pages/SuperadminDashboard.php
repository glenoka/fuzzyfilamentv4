<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Widgets\AccountWidget;
use App\Filament\Widgets\Participantoverview;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;
use BezhanSalleh\FilamentShield\Traits\HasShieldFormComponents;
 use BackedEnum;

class SuperadminDashboard extends Page
{
    use HasPageShield;
    protected string $view = 'filament.pages.superadmin-dashboard';
    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-home';
    protected static ?string $title = 'Halaman Superadmin';
        protected static ?string $navigationLabel = 'Home';
    protected static ?int $navigationSort = -2;
   protected function getHeaderWidgets(): array
{
    return [
        AccountWidget::class,
        ParticipantOverview::class
    ];
}
public function getHeaderWidgetsColumns(): int | array
{
    return 3;
}
}
