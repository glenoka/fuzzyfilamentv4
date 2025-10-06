<?php

namespace App\Filament\Pages\Auth;

use LogicException;
use App\Models\User;
use App\Models\Village;
use App\Models\Districts;



use App\Models\Formation;
use App\Models\Formation_Selection;

use App\Models\Participant;
use Filament\Actions\Action;
use Illuminate\Support\Facades\DB;
use Filament\Schemas\Schema;
use Filament\Facades\Filament;
use Filament\Auth\Pages\Register;
use Illuminate\Support\Facades\Hash;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Notifications\Notification;
use Illuminate\Validation\Rules\Password;

use Filament\Schemas\Components\Component;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Livewire\WithFileUploads;
use PhpOffice\PhpSpreadsheet\Calculation\LookupRef\Selection;

class CustomRegister extends Register
{
    use WithFileUploads;
     public ?array $data = [];
     public $image;

    /**
     * @var class-string<Model>
     */
    protected string $userModel;

    public function mount(): void
    {
        if (Filament::auth()->check()) {
            redirect()->intended(Filament::getUrl());
        }

        $this->callHook('beforeFill');

        $this->form->fill();

        $this->callHook('afterFill');
    }
    
    public function defaultForm(Schema $schema): Schema
    {
        return $schema
            ->statePath('data');
    }
    protected function getFormData(): Component
    {
         return Section::make('Informasi User')
            ->description('Silakan isi informasi pribadi Anda dengan benar.')
              ->schema([
               TextInput::make('name')
                        ->label('Full Name')
                        ->required()
                        ->maxLength(255),
                    TextInput::make('nik')->required()
                        ->label('NIK')
                        ->maxLength(16)
                        ->minLength(16)
                        ->unique(Participant::class, 'nik', ignoreRecord: true),
                    TextInput::make('place_of_birth')->required(),
                    DatePicker::make('date_of_birth'),
                    Select::make('gender')->required()
                        ->options([
                            'male' => 'Laki-laki',
                            'female' => 'Perempuan',
                        ]),
                    TextInput::make('telp')->required(),
                    Select::make('religion')->required()
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
                    Select::make('district_id')
                        ->label('District')
                        ->options(Districts::pluck('name', 'id'))
                        ->live()
                        ->afterStateUpdated(fn(Set $set) => $set('village_id', null)),

                    Select::make('village_id')->required()
                        ->label('Village')
                        ->options(function (Get $get) {
                            $districtId = $get('district_id');

                            if (!$districtId) {
                                return [];
                            }

                            return Village::where('district_id', $districtId)
                                ->pluck('name', 'id');
                        })
                        ->searchable(),
                   FileUpload::make('image')
                 ->image()
                ->directory('participant')
                ->columnSpanFull()
                ->maxSize(1120) // dalam KB
                ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/jpg'])
                ->helperText('Max size: 1MB, Format: JPEG, PNG, JPG'),
                    TextInput::make('username')->required()
                        ->label('Username')
                        ->maxLength(16)
                        ->minLength(6)
                        ->unique(User::class, 'username', ignoreRecord: true),
                    $this->getEmailFormComponent(),
                    $this->getPasswordFormComponent(),
                    $this->getPasswordConfirmationFormComponent(),
                    // ...
            ]);
    }
    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Pilihan Formasi')
            ->description('Silakan pilih formasi yang ingin Anda ikuti.')
            ->schema([
                Select::make('formation_id')
                    ->label('Formasi')
                    ->options(Formation::pluck('name', 'id'))
                    ->searchable()
                    ->preload()
                    ->required()
                    ->columnSpanFull(),
            ])
            ->columns(2)
            ->collapsible(),
                $this->getFormData(),
            ]);
           
    }

    protected function getNameFormComponent(): Component
    {
        return TextInput::make('name')
            ->label(__('filament-panels::auth/pages/register.form.name.label'))
            ->required()
            ->maxLength(255)
            ->autofocus();
    }

    protected function getEmailFormComponent(): Component
    {
        return TextInput::make('email')
            ->label(__('filament-panels::auth/pages/register.form.email.label'))
            ->email()
            ->required()
            ->maxLength(255)
            ->unique($this->getUserModel());
    }

    protected function getPasswordFormComponent(): Component
    {
        return TextInput::make('password')
            ->label(__('filament-panels::auth/pages/register.form.password.label'))
            ->password()
            ->revealable(filament()->arePasswordsRevealable())
            ->required()
            ->rule(Password::default())
            ->showAllValidationMessages()
            ->dehydrateStateUsing(fn ($state) => Hash::make($state))
            ->same('passwordConfirmation')
            ->validationAttribute(__('filament-panels::auth/pages/register.form.password.validation_attribute'));
    }

    protected function getPasswordConfirmationFormComponent(): Component
    {
        return TextInput::make('passwordConfirmation')
            ->label(__('filament-panels::auth/pages/register.form.password_confirmation.label'))
            ->password()
            ->revealable(filament()->arePasswordsRevealable())
            ->required()
            ->dehydrated(false);
    }

    public function loginAction(): Action
    {
        return Action::make('login')
            ->link()
            ->label(__('filament-panels::auth/pages/register.actions.login.label'))
            ->url(filament()->getLoginUrl());
    }

    protected function handleRegistration(array $data): Model
{
    return DB::transaction(function () use ($data) {

        // 1. Simpan ke tabel users
        $user = User::create([
            'name' => $data['name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => $data['password'], // Sudah di-hash oleh Filament
        ]);
        $imagePath = null;
          if ($this->image) {
        // Generate nama file unik
        $fileName = time() . '_' . $this->image->getClientOriginalName();
        
        // Simpan file ke storage
        $imagePath = $this->image->storeAs('participant', $fileName, 'public');
          }
 
        // 2. Simpan ke tabel participants
        $participant = Participant::create([
            'user_id'        => $user->id,
            'name'           => $data['name'],
            'nik'            => $data['nik'],
            'place_of_birth' => $data['place_of_birth'],
            'date_of_birth'  => $data['date_of_birth'],
            'gender'         => $data['gender'],
            'email'         => $data['email'],
            'telp'           => $data['telp'],
            'religion'       => $data['religion'],
            'address'        => $data['address'],
            'district_id'    => $data['district_id'],
            'village_id'     => $data['village_id'],
            'image'          => $data['image'] ,
            'status'         => 'active',
        ]);
$participant->user->assignRole('participant');
        // 3. Simpan ke tabel formation_selections
        Formation_Selection::create([
            'formation_id'  => $data['formation_id'],
            'participant_id'=> $participant->id,
            'status'        => 'progress',
        ]);
        Notification::make()
            ->title('Registrasi Berhasil! Silakan Login')
            ->success()
            ->send();
        
        return $user; // Filament butuh Model user untuk login langsung
    });
}
}
