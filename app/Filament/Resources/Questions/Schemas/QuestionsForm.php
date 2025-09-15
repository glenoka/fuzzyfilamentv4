<?php

namespace App\Filament\Resources\Questions\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;

class QuestionsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('question'),
                

                // TextInput::make('slug') 
                //     ->default(function() {
                //         return strtoupper(Str::random(6));
                //     })
                //     ->disabled() // Agar tidak bisa diedit
                //     ->dehydrated(), //agar tetap isa disimpan ini ya
                RichEditor::make('description'),
                Select::make('question_type')
                ->reactive()
                ->options([
                    'options' => 'Options',
                    'essay' => 'Essay',
                ])
                ->required(),
                
            
            Textarea::make('essay_answer_key')
                ->reactive()
                ->visible(fn (callable $get) => $get('question_type') === 'essay'), // Tampil hanya jika essay
            
            Repeater::make('options')
                    ->reactive()
                    ->relationship('options')
                ->schema([
                    TextInput::make('option_text')->required(),
                    TextInput::make('score')->required()->numeric(),
                ])
                ->visible(fn (callable $get) => $get('question_type') === 'options') // Tampil hanya jika options
            
                    
            ]);
    }
}
