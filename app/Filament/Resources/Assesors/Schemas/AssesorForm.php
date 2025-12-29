<?php

namespace App\Filament\Resources\Assesors\Schemas;

use App\Models\User;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Hash;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\Utilities\Set;

class AssesorForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
               
                Section::make('Profile Assessor')
                    ->description('Profile Assessor Data ')
                    ->schema([
                        TextInput::make('name')
                        ->label('Nama Assessor')
                        ->live(onBlur: true)
                            ->required()
                            // Memperbaiki copy email ke field email user
                            ->afterStateUpdated(function (Set $set, ?string $state) {
                                if ($state) {
                                    $set('user.name', $state);
                                }
                            }),
                        TextInput::make('user_id')->hidden()
                        ->live()
                        ->afterStateHydrated(function (Set $set, ?string $state) {
                            $dataUser=User::find($state);
                            if($dataUser){

                                $set('email', $dataUser->email);
                                $set('username', $dataUser->username);
                                $set('user.name', $dataUser->name);
                            }

                        }),
                        TextInput::make('place_of_birth')
                        ->required()
                        ->label('Tempat Lahir'),
                        DatePicker::make('date_of_birth')
                        ->required()
                        ->label('Tanggal Lahir'),
                        Select::make('gender')
                        ->label('Jenis Kelamin')
                            ->options([
                                'male' => 'Laki-laki',
                                'female' => 'Perempuan',
                            ]),
                        Select::make('religion')
                        ->label('Agama')
                            ->options([
                                'islam' => 'Islam',
                                'kristen' => 'Kristen',
                                'katolik' => 'Katolik',
                                'hindu' => 'Hindu',
                                'budha' => 'Budha',
                                'konghucu' => 'Konghucu',
                                'lainnya' => 'Lainnya',
                            ])->required(),
                        Textarea::make('address')->required()
                        ->label('Alamat Lengkap'),
                        TextInput::make('email_assessor')
                        ->label('Email Assessor')
                        ->live(onBlur: true)
                            ->required()
                            // Memperbaiki copy email ke field email user
                            ->afterStateUpdated(function (Set $set, ?string $state) {
                                if ($state) {
                                    $set('email', $state);
                                }
                            }),

                        TextInput::make('telp')
                        ->label('No. Telp')
                        ->required(),
                        Select::make('village_id')
                        ->label('Desa')
                            ->relationship('village', 'name')
                            ->searchable()
                            ->required(),
                        TextInput::make('status')
                        ->label('Status')
                            ->default('active')
                            ->disabled(),
                        FileUpload::make('image')->image()->directory('assessor')->columnSpanFull()
                        ->required()
                        ->label('Foto Assessor')
                        ->image(),

                    ])->columns(2),
                Section::make('Data User')
                    // Menghapus relationship karena akan dihandle manual
                    ->schema([
                        TextInput::make('user.name')->disabled()->label('Nama User'),
                        TextInput::make('username')->disabled(fn(string $context) => $context === 'update')->label('User'),
                        TextInput::make('email')
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
