<?php

namespace App\Filament\Resources\PracticeEvaluations\Tables;

use App\Models\Evaluation;
use Filament\Tables\Table;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;
use App\Filament\Resources\EvaluationResource;
use App\Filament\Resources\PracticeEvaluations\PracticeEvaluationResource;
use App\Filament\Resources\PracticeEvaluations\Schemas\PracticeEvaluationForm;

class PracticeEvaluationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
               TextColumn::make('assessor.name')
                    ->label('Assessor')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('participant.name')
                    ->label('Participant')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('date')
                    ->label('Date')
                    ->dateTime()
                    ->sortable()
                    ->searchable(),
                TextColumn::make('total_Score')
                    ->getStateUsing(function (Evaluation $record) {
                        // Hitung total score dari relasi examAnswers
                        return $record->evaluationDetails()->sum('score');
                    })
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                Action::make('doEvaluation')
                    ->label('Evaluate')
                    ->url(fn($record): string => PracticeEvaluationResource::getUrl('do-evaluation', ['record' => $record->id]))
                    // ->url(fn ($record): string => EvaluationResource::getUrl('do-evaluation', ['record' => $record]))
                    ->icon('heroicon-s-document-text')
                    ->color('primary'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
