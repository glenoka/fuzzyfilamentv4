<?php

namespace App\Filament\Resources\Exams\Tables;

use Filament\Tables\Table;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Illuminate\Support\Facades\Auth;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;
use App\Filament\Resources\Exams\ExamsResource;

class ExamsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('participant.name'),
                TextColumn::make('assessor.name'),
                TextColumn::make('package.name'),
                TextColumn::make('started_at')
                    ->default('Not Started'),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                Action::make('start_test')
                    ->label('Started')
                    ->icon('heroicon-o-play')
                    ->color('success')
                    ->url(function ($record) {
                        // Panggil method getUrl() dari Resource itu sendiri
                        // 'tryout' adalah nama kunci (key) dari array getPages()
                        return ExamsResource::getUrl('tryout', ['record' => $record->slug]);
                    })
                    ->visible(function ($record) {
                      /** @var \App\Models\User $user */
                        return $record->finish_at == null && Auth::user()->hasRole('Participant');
                    }),
                //EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
