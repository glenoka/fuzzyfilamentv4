<?php

namespace App\Filament\Resources\Admins\Schemas;

use App\Models\User;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Hash;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Illuminate\Support\Facades\Storage;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\Utilities\Set;

class AdminForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Profile Admin')
                ->description('Profile Data Admin ')
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
                            $set('user.name', $dataUser->name);
                            $set('email', $dataUser->email );
                            $set('user.email', $dataUser->email);
                            $set('username', $dataUser->username);
                        }


                    }),
                    TextInput::make('place_of_birth')
                    ->required(),
                    DatePicker::make('date_of_birth')->required(),
                    Select::make('gender')
                        ->options([
                            'male' => 'Laki-laki',
                            'female' => 'Perempuan',
                        ])->required(),
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
                    Textarea::make('address')
                    ->required(),
                    TextInput::make('email')
                    ->required()
                    ->live(onBlur: true)
                        // Memperbaiki copy email ke field email user
                        ->afterStateUpdated(function (Set $set, ?string $state) {
                            if ($state) {
                                $set('user.email', $state);
                            }
                        }),

                    TextInput::make('telp')->required()
                    ->tel(),
                    Select::make('village_id')
                        ->relationship('village', 'name')
                        ->searchable()
                        ->required(),
                    TextInput::make('status')
                        ->default('active')
                        ->disabled(),
                    FileUpload::make('image')->image()
                    ->label('Foto Profile')
                    ->image()
                    ->required()
                    ->directory('admin')->columnSpanFull()
                    ->deleteUploadedFileUsing(function ($state) {
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
