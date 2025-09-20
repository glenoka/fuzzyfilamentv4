<?php

namespace App\Filament\Resources\Exams\Schemas;

use App\Models\Package;
use Filament\Schemas\Schema;
use App\Models\Formation_Selection;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;

class ExamsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('package_id')
                    ->label('Select Package')
                    ->relationship('package', 'name')
                    ->live()
                    ->afterStateUpdated(function (Set $set, ?string $state) {
                        $set('participant_id', null);
                        if ($state) {

                            $package = Package::find($state);
                            $set('duration', $package->duration);
                        }
                    })->required(),
                Select::make('participant_id')
                    ->label('Select Participant')
                    ->options(function (Get $get) {
                        $packageId = $get('package_id');
        
                        if (!$packageId) {
                            return [];
                        }
                        $package = Package::find($packageId);
                        $formationId = $package->formation_id;

                        return Formation_Selection::with('participant')
                            ->where('status', 'accepted')
                            ->where('formation_id', $formationId)
                            ->get()
                            ->pluck('participant.name', 'participant.id');
                    })->required(),
                Select::make('assessor_id')
                    ->label('Select Assessor')
                    ->relationship('assessor', 'name')
                    ->required(),
                
                TextInput::make('duration')->readOnly(),
            ]);
    }
}
