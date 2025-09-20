<?php

namespace App\Filament\Resources\Exams;

use BackedEnum;
use App\Models\Exam;

use Filament\Tables\Table;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\Exams\Pages\Tryout;
use App\Filament\Resources\Exams\Pages\EditExams;
use App\Filament\Resources\Exams\Pages\ListExams;
use App\Filament\Resources\Exams\Pages\CreateExams;
use App\Filament\Resources\Exams\Schemas\ExamsForm;
use App\Filament\Resources\Exams\Tables\ExamsTable;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ExamsResource extends Resource
{
    protected static ?string $model = Exam::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return ExamsForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ExamsTable::configure($table);
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
            'index' => ListExams::route('/'),
            'create' => CreateExams::route('/create'),
            'edit' => EditExams::route('/{record}/edit'),
        ];
    }
     public static function getEloquentQuery(): Builder
    {
        $query= parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
        $role=Auth::user()->roles->first()->name;
     
        if($role=="participant"){
            return $query->whereHas('participant', function ($query) {
                $query->where('user_id', Auth::user()->id);
            });
        }

        if($role=="assessor"){
            return $query->whereHas('assessor', function ($query) {
                $query->where('user_id', Auth::user()->id);
            });
           
        }
    
       
        return $query;
    }
   
}
