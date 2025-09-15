<?php

namespace App\Filament\Resources\FormationSelections;

use BackedEnum;
use Filament\Tables\Table;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use App\Models\Formation_Selection;
use Filament\Support\Icons\Heroicon;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\FormationSelections\Pages\EditFormationSelection;
use App\Filament\Resources\FormationSelections\Pages\ListFormationSelections;
use App\Filament\Resources\FormationSelections\Pages\CreateFormationSelection;
use App\Filament\Resources\FormationSelections\Schemas\FormationSelectionForm;
use App\Filament\Resources\FormationSelections\Tables\FormationSelectionsTable;
use App\Filament\Resources\FormationSelections\Pages\DetailFormationSelection;

class FormationSelectionResource extends Resource
{
    protected static ?string $model = Formation_Selection::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return FormationSelectionForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return FormationSelectionsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }
     public static function getEloquentQuery(): Builder
{
        return parent::getEloquentQuery()->with('participant');
    }

    public static function getPages(): array
    {
        return [
            'index' => ListFormationSelections::route('/'),
            'detail' => DetailFormationSelection::route('/{record}'),
            'create' => CreateFormationSelection::route('/create'),
            'edit' => EditFormationSelection::route('/{record}/edit'),
        ];
    }
}
