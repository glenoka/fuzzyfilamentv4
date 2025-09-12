<?php

namespace App\Filament\Resources\Participants\Schemas;

use App\Models\User;
use App\Models\Village;
use App\Models\Districts;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Hash;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Illuminate\Support\Facades\Storage;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;

class ParticipantForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                  Section::make('Profile Participant')
                    ->description('Profile Data Participant ')
                    ->schema([
                        TextInput::make('name')
                            ->live(onBlur: true)
                            ->required()
                          
                            ->afterStateUpdated(function (Set $set, ?string $state) {
                                if ($state) {
                                    $set('user.name', $state);
                                }
                            }),
                        TextInput::make('user_id')->hidden()
                            ->live()
                            ->required()
                            ->afterStateHydrated(function (Set $set, ?string $state) {
                                $dataUser = User::find($state);
                                if ($dataUser) {
                                    $set('user.name', $dataUser->name);
                                    $set('user.email', $dataUser->email);
                                    $set('username', $dataUser->username);
                                }
                            }),
                        TextInput::make('nik')->required(),
                        TextInput::make('place_of_birth')->required(),
                        DatePicker::make('date_of_birth')->required(),
                        Select::make('gender')
                            ->options([
                                'male' => 'Laki-laki',
                                'female' => 'Perempuan',
                            ])->required(),
                        Select::make('religion')
                        ->required()
                            ->options([
                                'islam' => 'Islam',
                                'kristen' => 'Kristen',
                                'katolik' => 'Katolik',
                                'hindu' => 'Hindu',
                                'budha' => 'Budha',
                                'konghucu' => 'Konghucu',
                                'lainnya' => 'Lainnya',
                            ]),
                        Textarea::make('address')->required(),
                        TextInput::make('email')
                        ->live(onBlur: true)
                            ->afterStateUpdated(function (Set $set, ?string $state) {
                                if ($state) {
                                    $set('user.email', $state);
                                }
                            })->required(),

                        TextInput::make('telp')->required()
                        ->tel(),
                        Select::make('district_id')
                            ->label('District')
                            ->options(Districts::pluck('name', 'id'))
                            ->live()
                            ->afterStateUpdated(fn(Set $set) => $set('village_id', null))
                            ->required(),

                            Select::make('village_id')
                            ->label('Village')
                            ->options(function (Get $get) {
                                $districtId = $get('district_id');
                                
                                if (!$districtId) {
                                    return Village::query()->limit(50)->pluck('name', 'id');
                                }
                                
                                return Village::where('district_id', $districtId)->pluck('name', 'id');
                            })
                            ->searchable()
                            ->required()
                            ->live()
                            ->placeholder('Select Village')
                            ->disabled(fn (Get $get): bool => !$get('district_id'))
                            ->afterStateHydrated(function (Set $set, ?string $state) {
                                if ($state) {
                                    $dataVillage = Village::find($state);
                                    if ($dataVillage) {
                                        $set('district_id', $dataVillage->district_id);
                                    }
                                }
                            }),
                        
                        TextInput::make('status')
                            ->default('active')
                            ->disabled(),
                        FileUpload::make('image')->image()
                            ->directory('participant')->columnSpanFull()
                            ->required()
                            ->deleteUploadedFileUsing(
                                function ($state) {
                                    if ($state) {
                                        Storage::disk('public')->delete($state);
                                    }
                                }
                            ),


                    ])->columns(2),
                Section::make('Data User')
                    // Menghapus relationship karena akan dihandle manual
                    ->schema([
                        TextInput::make('user.name')->disabled(),
                        TextInput::make('username')->disabled(fn(string $context) => $context === 'update'),
                        TextInput::make('user.email')
                            ->email()
                            ->disabled(),
                        TextInput::make('password')
                            ->password()
                            ->revealable(filament()->arePasswordsRevealable())
                            ->dehydrateStateUsing(fn($state) => Hash::make($state))
                            ->dehydrated(fn($state) => filled($state))
                            ->required(fn(string $context) => $context === 'create'),


                    ])

           
            ]);
    }
}
