<?php

declare(strict_types=1);

namespace App\Filament\Pages\Auth;

use App\Actions\CreateTeamWithUniqueSlug;
use App\Enums\Country;
use App\Enums\UserRole;
use App\Models\Team;
use Closure;
use Filament\Auth\Pages\Register as BaseRegister;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Madbox99\UserTeamSync\Facades\UserTeamSync;
use Override;

final class Register extends BaseRegister
{
    public string $view = 'filament.pages.auth.register';

    protected static string $layout = 'filament.layouts.auth-split';

    private ?string $rawPassword = null;

    protected function beforeValidate(): void
    {
        // Capture raw password before form dehydration hashes it
        $this->rawPassword = $this->data['password'] ?? null;
    }

    #[Override]
    protected function handleRegistration(array $data): Model
    {
        // Self-registration always creates a main (owner) account, which must be
        // able to manage its own users, so it registers as a Manager rather than
        // the default Subscriber role.
        $data['role'] = UserRole::Manager->value;

        $user = parent::handleRegistration($data);

        // The team slug must be unique (it is the receiver apps' team key and
        // the Filament tenant route segment). A plain Str::slug() of the
        // company name collides whenever two customers share a name, which
        // aborted registration and skipped cross-app provisioning entirely.
        $team = app(CreateTeamWithUniqueSlug::class)->handle((string) $user->company_name);

        $user->teams()->attach($team);

        UserTeamSync::createUser(
            email: $user->email,
            name: $user->name,
            password: $this->rawPassword,
            role: $user->role?->value ?? UserRole::Manager->value,
            ownerEmail: $user->email,
            uuid: $user->uuid,
        );

        UserTeamSync::createTeam(
            teamName: $user->company_name,
            userEmail: $user->email,
            slug: $team->slug,
            userName: $user->name,
            uuid: $team->uuid,
        );

        return $user;
    }

    #[Override]
    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                $this->getNameFormComponent(),
                $this->getEmailFormComponent(),
                $this->getPasswordFormComponent(),
                $this->getPasswordConfirmationFormComponent(),
                $this->getCompanyFieldset(),
            ])
            ->columns(2);
    }

    private function getCompanyFieldset(): Fieldset
    {
        return Fieldset::make('Company information')
            ->translateLabel()
            ->schema([
                TextInput::make('company_name')
                    ->required()
                    ->maxLength(length: 255)
                    ->rule(static fn (): Closure => static function (string $attribute, mixed $value, Closure $fail): void {
                        if (Team::query()->where('slug', Str::slug((string) $value))->exists()) {
                            $fail(__('This company name is already registered. Please choose a different one.'));
                        }
                    }),

                TextInput::make('tax_number')
                    ->required()
                    ->maxLength(length: 255),

                TextInput::make('address')
                    ->required()
                    ->maxLength(length: 255),

                TextInput::make('city')
                    ->required()
                    ->maxLength(length: 255),

                TextInput::make(name: 'postal_code')
                    ->required()
                    ->maxLength(length: 20),

                Select::make('country')
                    ->options(Country::class)
                    ->default(Country::Hungary)
                    ->required(),
            ])
            ->columns(2)
            ->columnSpanFull();
    }
}
