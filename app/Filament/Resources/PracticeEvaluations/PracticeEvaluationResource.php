<?php

namespace App\Filament\Resources\PracticeEvaluations;

use App\Filament\Resources\PracticeEvaluations\Pages\CreatePracticeEvaluation;
use App\Filament\Resources\PracticeEvaluations\Pages\EditPracticeEvaluation;
use App\Filament\Resources\PracticeEvaluations\Pages\ListPracticeEvaluations;
use App\Filament\Resources\PracticeEvaluations\Schemas\PracticeEvaluationForm;
use App\Filament\Resources\PracticeEvaluations\Tables\PracticeEvaluationsTable;
use App\Models\Evaluation;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PracticeEvaluationResource extends Resource
{
    protected static ?string $model = Evaluation::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return PracticeEvaluationForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PracticeEvaluationsTable::configure($table);
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
            'index' => ListPracticeEvaluations::route('/'),
            'create' => CreatePracticeEvaluation::route('/create'),
            'do-evaluation' => Pages\DoEvaluation::route('/{record}/do-evaluation'),
            'edit' => EditPracticeEvaluation::route('/{record}/edit'),

        ];
    }
}
