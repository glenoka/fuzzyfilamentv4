<?php

namespace App\Filament\Resources\Formations\Schemas;

use App\Models\Village;
use App\Models\Districts;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;

class FormationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
               TextInput::make('name'),
                Select::make('district_id')
                    ->label('Kecamatan')
                    ->options(Districts::pluck('name', 'id'))
                    ->live()
                    ->afterStateUpdated(fn(Set $set) => $set('village_id', null)),

                Select::make('village_id')->required()
                    ->label('Desa')
                    ->options(function (Get $get) {
                        $districtId = $get('district_id');

                        if (!$districtId) {
                            return [];
                        }

                        return Village::where('district_id', $districtId)
                            ->pluck('name', 'id');
                    })
                    ->searchable(),
                    DatePicker::make('due_date')
                    ->label('Waktu Berakhir')
                    ->required(),
                TextInput::make('status')
                    ->label('Status')
                    ->required()
                    ->default('active'),
                TextInput::make('education_level')
                    ->label('Tingkat Pendidikan')
                    ->required(),
                TextInput::make('open_position')
                    ->label('Posisi')
                    ->required(),
                RichEditor::make('description'),
            ]);
    }
}
