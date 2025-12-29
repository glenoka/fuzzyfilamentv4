<?php

namespace App\Filament\Resources\FormationSelections\Schemas;

use App\Models\Formation;
use App\Models\Participant;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Illuminate\Database\Eloquent\Builder;


class FormationSelectionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                 Select::make('formation_id')
                ->label('Formasi')
                ->options(Formation::pluck('name', 'id'))
                ->live(),
                Select::make('participant_id')
                ->label('Peserta')
                ->options(Participant::pluck('name', 'id'))
                ->unique()
                    ->validationMessages([
                        'unique' => 'Participant Allready Register',
                    ])
            ]);
    }
   
}
