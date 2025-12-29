<?php

namespace App\Filament\Resources\Exams\Schemas;

use App\Models\Package;
use Filament\Schemas\Schema;
use App\Models\Formation_Selection;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;

class ExamsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('package_id')
                    ->label('Pilih Paket Soal')
                    ->relationship('package', 'name')
                    ->live()
                    ->afterStateUpdated(function (Set $set, ?string $state) {
                        $set('participant_id', null);
                        if ($state) {

                            $package = Package::find($state);
                            $set('duration', $package->duration);
                        }
                    })->required(),
                Select::make('participant_ids') // GANTI NAMA FIELD DI SINI
            ->label('Pilih Peserta (Bisa Pilih Banyak)')
            ->multiple() // Tetap gunakan multiple
            ->options(function (Get $get) {
                // Logika untuk mengambil options tetap sama
                $packageId = $get('package_id');
                if (!$packageId) {
                    return [];
                }
                $package = Package::find($packageId);
                $formationId = $package->formation_id;

                return Formation_Selection::with('participant')
                    ->where('status', 'accepted')
                    ->where('formation_id', $formationId)
                    ->get()
                    ->pluck('participant.name', 'participant_id'); // Pastikan Anda pluck 'participant_id'
            })
            ->required(),

                Select::make('assessor_id')
                    ->label('Pilih Penguji')
                    ->relationship('assessor', 'name')
                    ->required(),
                
                TextInput::make('duration')->readOnly(),
            ]);
    }
}
