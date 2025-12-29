<?php

namespace App\Filament\Resources\Assesors\Tables;

use Filament\Tables\Table;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;

class AssesorsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                ->label('Nama Assesor'),
                TextColumn::make('email_assessor')
                ->label('Email Assesor'),
                TextColumn::make('telp')
                ->label('No. Telp'),
                TextColumn::make('status')
                ->label('Status'),
                ImageColumn::make('image')
                ->label('Foto'),
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
