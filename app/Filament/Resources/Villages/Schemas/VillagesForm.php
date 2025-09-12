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
                ->label('Village Name'),
                Select::make('district_id')
                ->relationship('district', 'name')
            ]);
    }
}
