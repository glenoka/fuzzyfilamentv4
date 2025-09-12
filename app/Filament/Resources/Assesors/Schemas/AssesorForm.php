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
                        ->required(),
                        DatePicker::make('date_of_birth')
                        ->required(),
                        Select::make('gender')
                            ->options([
                                'male' => 'Laki-laki',
                                'female' => 'Perempuan',
                            ]),
                        Select::make('religion')
                            ->options([
                                'islam' => 'Islam',
                                'kristen' => 'Kristen',
                                'katolik' => 'Katolik',
                                'hindu' => 'Hindu',
                                'budha' => 'Budha',
                                'konghucu' => 'Konghucu',
                                'lainnya' => 'Lainnya',
                            ])->required(),
                        Textarea::make('address')->required(),
                        TextInput::make('email_assessor')
                        ->live(onBlur: true)
                            ->required()
                            // Memperbaiki copy email ke field email user
                            ->afterStateUpdated(function (Set $set, ?string $state) {
                                if ($state) {
                                    $set('email', $state);
                                }
                            }),

                        TextInput::make('telp')
                        ->required(),
                        Select::make('village_id')
                            ->relationship('village', 'name')
                            ->searchable()
                            ->required(),
                        TextInput::make('status')
                            ->default('active')
                            ->disabled(),
                        FileUpload::make('image')->image()->directory('assessor')->columnSpanFull()
                        ->required()
                        ->label('Image Profile')
                        ->image(),

                    ])->columns(2),
                Section::make('Data User')
                    // Menghapus relationship karena akan dihandle manual
                    ->schema([
                        TextInput::make('user.name')->disabled(),
                        TextInput::make('username')->disabled(fn(string $context) => $context === 'update'),
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
