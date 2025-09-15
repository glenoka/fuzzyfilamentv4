<?php

namespace App\Filament\Resources\Sections\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;

class SectionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                ->label('Section Name'),
                Repeater::make('aspects')
                    ->relationship() // Membuat relationship dengan Aspect
                    ->schema([
                        TextInput::make('task')
                            ->required()
                            ->label('Task/Aspek Penilaian'),
                            
                        TextInput::make('max_score')
                            ->required()
                            ->numeric()
                            ->label('Nilai Maksimal')
                            ->minValue(1),
                    ])
                    ->columns(2)
                    ->columnSpan('full')
                    ->label('Daftar Aspek Penilaian')
            ]);
    }
}
