<?php

namespace App\Filament\Resources\FormationSelections\Tables;

use App\Filament\Resources\FormationSelections\FormationSelectionResource;
use Filament\Actions\Action;
use Filament\Tables\Table;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;

class FormationSelectionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                 TextColumn::make('formation.name')->label('Formasi'),
               TextColumn::make('participant.name')->label('Peserta'),
               TextColumn::make('status')
               ->badge()
               ->label('Status')
               ->color(fn (string $state): string => match ($state) {
                   'progress' => 'warning',
                   'accepted' => 'success',
                   'rejected' => 'danger',
                   default => 'gray',
               }),
            ])
            ->filters([
                  SelectFilter::make('formation')
                ->relationship('formation', 'name')
                ->indicator('Formasi')
                ->multiple()
                ->searchable()
                ->preload()
                ->label('Filter berdasarkan Formasi')
                ->placeholder('Semua Formasi'),
            ])
            ->recordActions([
                EditAction::make(),
                Action::make('detail') // Beri nama action 'detail'
                ->label('Lihat Detail') // (Opsional) Ganti label tombol
                ->icon('heroicon-o-eye') // (Opsional) Tambahkan ikon
                ->color('info') // (Opsional) Ganti warna tombol
                ->url(fn ($record) => FormationSelectionResource::getUrl('detail', ['record' => $record])), // Memanggil kunci 'detail'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
