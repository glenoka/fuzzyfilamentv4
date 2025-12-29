<?php

namespace App\Filament\Resources\Villages\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;

class VillagesForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                ->label('Nama Desa/Kelurahan'),
                Select::make('district_id')
                ->label('Kecamatan/Kota')
                ->relationship('district', 'name')
            ]);
    }
}
