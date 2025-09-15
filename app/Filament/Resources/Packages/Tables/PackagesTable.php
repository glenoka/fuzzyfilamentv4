<?php

namespace App\Filament\Resources\Packages\Tables;

use Filament\Tables\Table;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Actions\ForceDeleteBulkAction;

class PackagesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
               TextColumn::make('name')
                    ->searchable(),
                textColumn::make('duration')
                    ->numeric()
                    ->label('Menit')
                    ->sortable(),
                textColumn::make('type_package')
                    ->label('Tipe Paket'),
                textColumn::make('package_questions_count')
                    ->counts('package_questions')
                    ->label('Jumlah Soal')
                    ->numeric()
                    ->sortable(),
                textColumn::make('criteria.criteria')
                    ->label('Creteria'),
                textColumn::make('formation.name'),
                textColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                textColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
              TrashedFilter::make(),
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
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }
}
