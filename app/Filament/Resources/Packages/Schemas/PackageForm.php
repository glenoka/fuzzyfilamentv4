<?php

namespace App\Filament\Resources\Packages\Schemas;


use App\Models\Criteria;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Group;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;


class PackageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                 Group::make()
                    ->schema([
                        Section::make()
                           ->schema([
                                TextInput::make('name')
                                    ->required()
                                    ->maxLength(255),
                                TextInput::make('duration')
                                    ->required()
                                    ->numeric(),
                                Select::make('type_package')
                                    ->options([
                                        'option' => 'Multiple Choice',
                                        'essay' => 'Essay',
                                    ])
                                    ->required()
                                    ->label('Tipe Soal'),
                                
                                Select::make('criteria_id')
                                    ->options(Criteria::pluck('criteria', 'id'))
                                    ->required()
                                    ->label('Creteria'),
                                    Select::make('formation_id')
                                    ->label('Formasi')
                                    ->relationship('formation', 'name')
                                    ->required()
                                    ->label('Formation')
                                    ->columnSpanFull(),
                            ])->columns(2),
                    ]),
                Repeater::make('package_questions')
                    ->relationship('package_questions')
                    ->schema([
                        Select::make('question_id')
                            ->relationship('question', 'question')
                            ->label('Soal')
                            ->getOptionLabelFromRecordUsing(fn($record) => "{$record->question} - [{$record->question_type}]")
                            ->disableOptionsWhenSelectedInSiblingRepeaterItems()
                            ->required(),
                    ])
            
            ]);
    }
}
