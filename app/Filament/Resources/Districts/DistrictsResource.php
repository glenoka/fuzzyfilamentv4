<?php

namespace App\Filament\Resources\Districts;

use App\Filament\Resources\Districts\Pages\CreateDistricts;
use App\Filament\Resources\Districts\Pages\EditDistricts;
use App\Filament\Resources\Districts\Pages\ListDistricts;
use App\Filament\Resources\Districts\Schemas\DistrictsForm;
use App\Filament\Resources\Districts\Tables\DistrictsTable;
use App\Models\Districts;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DistrictsResource extends Resource
{
    protected static ?string $model = Districts::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return DistrictsForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DistrictsTable::configure($table);
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
            'index' => ListDistricts::route('/'),
            //'create' => CreateDistricts::route('/create'),
            'edit' => EditDistricts::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
