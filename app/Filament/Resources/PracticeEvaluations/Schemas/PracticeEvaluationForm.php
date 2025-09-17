<?php

namespace App\Filament\Resources\PracticeEvaluations\Schemas;

use App\Models\Formation;
use Filament\Schemas\Schema;
use App\Models\Formation_Selection;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Schemas\Components\Utilities\Get;

class PracticeEvaluationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                 Select::make('assessor_id')
                    ->relationship('assessor', 'name')
                    ->required()
                    ->label('Assessor'),
             Select::make('formation_id')
                    ->options(Formation::all()->pluck('name', 'id'))
                    ->required()
                    ->live()
                    ->label('Formation'),
                Select::make('participant_id')
                    ->label('Select Participant')
                    ->options(function (Get $get) {
                        $formationId = $get('formation_id');

                        return Formation_Selection::with('participant')
                            ->where('status', 'accepted')
                            ->where('formation_id', $formationId)
                            ->get()
                            ->pluck('participant.name', 'participant.id');
                    })->required(),
               DatePicker::make('date')
                    ->required()
                    ->label('Date')
                    ->default(now()),
            ]);
    }
}
