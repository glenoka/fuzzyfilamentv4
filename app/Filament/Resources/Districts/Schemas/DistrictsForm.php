<?php

namespace App\Filament\Resources\Districts\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;

class DistrictsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name'),
            ]);
    }
}
