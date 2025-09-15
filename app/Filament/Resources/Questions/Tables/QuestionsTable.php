<?php

namespace App\Filament\Resources\Questions\Tables;

use Filament\Tables\Table;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;

class QuestionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                  TextColumn::make('question'),
                TextColumn::make('question_type'),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
