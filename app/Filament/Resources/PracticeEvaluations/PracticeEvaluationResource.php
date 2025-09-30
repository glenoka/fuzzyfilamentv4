<?php

namespace App\Filament\Resources\PracticeEvaluations;

use BackedEnum;
use App\Models\Evaluation;
use Filament\Tables\Table;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\PracticeEvaluations\Pages\EditPracticeEvaluation;
use App\Filament\Resources\PracticeEvaluations\Pages\ListPracticeEvaluations;
use App\Filament\Resources\PracticeEvaluations\Pages\CreatePracticeEvaluation;
use App\Filament\Resources\PracticeEvaluations\Schemas\PracticeEvaluationForm;
use App\Filament\Resources\PracticeEvaluations\Tables\PracticeEvaluationsTable;

class PracticeEvaluationResource extends Resource
{
    protected static ?string $model = Evaluation::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::Lifebuoy;

    protected static ?string $recordTitleAttribute = 'name';
        protected static ?string $navigationLabel = 'Data Penilaian Praktik';

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
    public static function getEloquentQuery(): Builder
    {
        $user = Auth::user();
        
        // Jika user memiliki relasi assessor
        if ($user->assessor) {
            return parent::getEloquentQuery()
                ->where('assessor_id', $user->assessor->id);
        }
        
        // Jika user tidak memiliki assessor, return query kosong
        return parent::getEloquentQuery()->whereNull('assessor_id');
    }
}
