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
                  Section::make('Data Peserta')
                    ->description('Lengkapi data peserta dengan benar.')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nama Lengkap')
                            ->live(onBlur: true)
                            ->required()
                          
                            ->afterStateUpdated(function (Set $set, ?string $state) {
                                if ($state) {
                                    $set('user.name', $state);
                                }
                            }),
                        TextInput::make('user_id')->hidden()
                        ->label('Username')
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
                        TextInput::make('nik')->required()->label('NIK'),
                        TextInput::make('place_of_birth')->required()->label('Tempat Lahir'),
                        DatePicker::make('date_of_birth')->required()->label('Tanggal Lahir'),
                        Select::make('gender')
                        ->label('Jenis Kelamin')
                            ->options([
                                'male' => 'Laki-laki',
                                'female' => 'Perempuan',
                            ])->required(),
                        Select::make('religion')
                        ->required()
                        ->label('Agama')
                            ->options([
                                'islam' => 'Islam',
                                'kristen' => 'Kristen',
                                'katolik' => 'Katolik',
                                'hindu' => 'Hindu',
                                'budha' => 'Budha',
                                'konghucu' => 'Konghucu',
                                'lainnya' => 'Lainnya',
                            ]),
                        Textarea::make('address')->required()->label('Alamat'),
                        TextInput::make('email')
                        ->label('Email')
                            ->label('Email')
                        ->live(onBlur: true)
                            ->afterStateUpdated(function (Set $set, ?string $state) {
                                if ($state) {
                                    $set('user.email', $state);
                                }
                            })->required(),

                        TextInput::make('telp')->required()
                        ->label('No. Telp')
                        ->tel(),
                        Select::make('district_id')
                            ->label('Kecamatan/Kota')
                            ->options(Districts::pluck('name', 'id'))
                            ->live()
                            ->afterStateUpdated(fn(Set $set) => $set('village_id', null))
                            ->required(),

                            Select::make('village_id')
                            ->label('Desa/Kelurahan')
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
                            ->label('Foto Peserta')
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
                        TextInput::make('user.name')->disabled()->label('Nama Peserta'),
                        TextInput::make('username')->disabled(fn(string $context) => $context === 'update')->label('Username'),
                        TextInput::make('user.email')
                            ->email()
                            ->label('Email Peserta')
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
