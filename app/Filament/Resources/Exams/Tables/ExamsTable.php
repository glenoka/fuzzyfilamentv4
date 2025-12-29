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
                TextColumn::make('participant.name')
                    ->label('Nama Peserta')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('assessor.name')->label('Nama Penguji'),
                TextColumn::make('package.name')->label('Nama Paket Soal'),
                TextColumn::make('started_at')
                    ->default('Belum Dimulai'),
                TextColumn::make('total_score')
                    ->default('-'),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                Action::make('start_test')
                    ->label('Mulai Ujian')
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
