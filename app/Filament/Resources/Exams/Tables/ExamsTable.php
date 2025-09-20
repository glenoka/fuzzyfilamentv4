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
                TextColumn::make('total_score')
                    ->default('Not Graded'),
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
                        
                       return route('tryout.page', ['id' => $record->slug]);
                    })->openUrlInNewTab(true)
                    ->visible(function ($record) {
                      /** @var \App\Models\User $user */
                     
                        return $record->finish_at == null && Auth::user()->hasRole('participant');
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
