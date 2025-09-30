<?php

namespace App\Filament\Pages;


use App\Models\Ranking;
use Filament\Pages\Page;
use Filament\Tables\Table;
use App\Models\Participant;
use App\Models\Formation_Selection;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;
use Illuminate\Support\Facades\Auth;
use Filament\Tables\Columns\TextColumn;

use Filament\Tables\Contracts\HasTable;
use Illuminate\Database\Eloquent\Model;
use Filament\Tables\Concerns\InteractsWithTable;
 use BackedEnum;

class FormationRank extends Page implements HasTable
{
    protected string $view = 'filament.pages.formation-rank';
 protected static ?string $title = 'Ranking Formasi';
   protected static ?string $navigationLabel = 'Peringkat';

protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-chart-bar';

    use InteractsWithTable;
    use HasPageShield;

    public ?array $data=[];
    public $participant;
    public $rankData=[];
    public $formation;
    public $rank;
    public $user;

    public function mount(){
        $this->user = Auth::user()->id;
        $this->participant=Participant::where('user_id',$this->user)->first();
    
        $this->formation=Formation_Selection::where('participant_id',$this->participant->id)->first();
        $this->rankData=Ranking::where('formation_id',$this->formation->formation_id)->with('participant','formation')->get();
        $this->rank=Ranking::where('participant_id',$this->participant->id)->first();
        
    }
    public function table(Table $table): Table
    {
        return $table
            ->query(Ranking::where('formation_id',$this->formation->formation_id)->with('participant','formation'))
            ->columns([
                TextColumn::make('participant.name'),
                TextColumn::make('formation.name'),
                TextColumn::make('total_score'),
                TextColumn::make('rank')
            ])
            ->recordClasses(function (Model $record) {
    if ($record->rank == $this->rank->rank) {
        // Cukup kembalikan string berisi kelas CSS
        return 'bg-green-100 dark:bg-green-800/50';
    }
 
    return null; // Kembalikan null jika tidak ada kelas yang ditambahkan
})

            ->filters([
                // ...
            ])
            ->recordActions([
                // ...
            ])
            ->toolbarActions([
                // ...
            ]);
    }

}
