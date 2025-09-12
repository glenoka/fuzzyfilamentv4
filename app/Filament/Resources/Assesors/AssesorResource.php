<?php

namespace App\Filament\Resources\Assesors;

use App\Filament\Resources\Assesors\Pages\CreateAssesor;
use App\Filament\Resources\Assesors\Pages\EditAssesor;
use App\Filament\Resources\Assesors\Pages\ListAssesors;
use App\Filament\Resources\Assesors\Schemas\AssesorForm;
use App\Filament\Resources\Assesors\Tables\AssesorsTable;
use App\Models\Assessor;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class AssesorResource extends Resource
{
    protected static ?string $model = Assessor::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return AssesorForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AssesorsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListAssesors::route('/'),
            'create' => CreateAssesor::route('/create'),
            'edit' => EditAssesor::route('/{record}/edit'),
        ];
    }
}
