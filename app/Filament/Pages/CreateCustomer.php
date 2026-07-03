<?php

declare(strict_types=1);

namespace App\Filament\Pages;

use App\Actions\CreateCustomer as CreateCustomerAction;
use App\Enums\Country;
use App\Enums\UserRole;
use App\Filament\Resources\Users\UserResource;
use App\Models\Plan;
use BackedEnum;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\Auth;
use Override;

final class CreateCustomer extends Page
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUserPlus;

    protected static ?string $slug = 'uj-ugyfel';

    protected static ?string $navigationLabel = 'Új ügyfél';

    protected static ?string $title = 'Új ügyfél létrehozása';

    protected static ?int $navigationSort = 1;

    protected string $view = 'filament.pages.create-customer';

    /** @var array<string, mixed> */
    public ?array $data = [];

    #[Override]
    public static function shouldRegisterNavigation(): bool
    {
        return Auth::user()?->isAdmin() ?? false;
    }

    public static function canAccess(): bool
    {
        return Auth::user()?->isAdmin() ?? false;
    }

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Wizard::make([
                    Step::make('Főfiók')
                        ->schema([
                            TextInput::make('name')->label('Név')->required()->maxLength(255),
                            TextInput::make('email')->label('E-mail')->email()->required()
                                ->unique('users', 'email')->maxLength(255),
                            TextInput::make('password')->label('Jelszó')->password()->required()->minLength(8),
                            Select::make('role')->label('Szerep')
                                ->options([
                                    UserRole::Manager->value => 'Manager',
                                    UserRole::Subscriber->value => 'Subscriber',
                                    UserRole::Admin->value => 'Admin',
                                ])
                                ->default(UserRole::Manager->value)->required(),
                            TextInput::make('company_name')->label('Cégnév')->required()->maxLength(255),
                            TextInput::make('tax_number')->label('Adószám')->required()->maxLength(255),
                            TextInput::make('address')->label('Cím')->required()->maxLength(255),
                            TextInput::make('city')->label('Város')->required()->maxLength(255),
                            TextInput::make('postal_code')->label('Irányítószám')->required()->maxLength(20),
                            Select::make('country')->label('Ország')
                                ->options(Country::class)->default(Country::Hungary)->required(),
                        ])
                        ->columns(2),
                    Step::make('Csomagok')
                        ->schema([
                            Repeater::make('plans')
                                ->label('Csomagok')
                                ->schema([
                                    Select::make('plan_id')->label('Csomag')
                                        ->options(fn (): array => Plan::query()->active()
                                            ->with('planCategory')->get()
                                            ->mapWithKeys(fn (Plan $plan): array => [
                                                $plan->id => ($plan->planCategory?->name ? $plan->planCategory->name . ' — ' : '') . $plan->name,
                                            ])->all())
                                        ->required()->searchable(),
                                    TextInput::make('quantity')->label('Férőhelyek (owner + tagok)')
                                        ->integer()->minValue(1)->default(1)->required(),
                                ])
                                ->minItems(1)->defaultItems(1)->columns(2)
                                ->addActionLabel('Csomag hozzáadása'),
                        ]),
                    Step::make('Team')
                        ->schema([
                            Toggle::make('create_team')->label('Team létrehozása')->default(false)->live(),
                            TextInput::make('team_name')->label('Team neve')
                                ->placeholder('Alapértelmezés: a cégnév')
                                ->visible(fn (Get $get): bool => (bool) $get('create_team')),
                        ]),
                    Step::make('Tagok')
                        ->schema([
                            Repeater::make('members')
                                ->label('Tagok')
                                ->schema([
                                    TextInput::make('name')->label('Név')->required()->maxLength(255),
                                    TextInput::make('email')->label('E-mail')->email()->required()
                                        ->unique('users', 'email')->maxLength(255),
                                    TextInput::make('password')->label('Jelszó')->password()->required()->minLength(8),
                                    Select::make('role')->label('Szerep')
                                        ->options([
                                            UserRole::Subscriber->value => 'Subscriber',
                                            UserRole::Manager->value => 'Manager',
                                        ])
                                        ->default(UserRole::Subscriber->value)->required(),
                                ])
                                ->defaultItems(0)->columns(2)
                                ->addActionLabel('Tag hozzáadása'),
                        ]),
                    Step::make('Összegzés')
                        ->schema([
                            Placeholder::make('summary_owner')
                                ->label('Főfiók')
                                ->content(fn (Get $get): string => sprintf(
                                    '%s (%s) — %s',
                                    $get('name') ?: '—',
                                    $get('email') ?: '—',
                                    $get('company_name') ?: '—',
                                )),
                            Placeholder::make('summary_plans')
                                ->label('Csomagok')
                                ->content(function (Get $get): string {
                                    $rows = collect($get('plans') ?? []);

                                    if ($rows->isEmpty()) {
                                        return 'Nincs kiválasztott csomag';
                                    }

                                    $names = Plan::query()
                                        ->whereIn('id', $rows->pluck('plan_id')->filter()->all())
                                        ->pluck('name', 'id');

                                    return $rows->map(fn (array $row): string => sprintf(
                                        '%s (%d férőhely)',
                                        $names[$row['plan_id']] ?? '#' . $row['plan_id'],
                                        (int) $row['quantity'],
                                    ))->implode(', ');
                                }),
                            Placeholder::make('summary_team')
                                ->label('Team')
                                ->content(fn (Get $get): string => $get('create_team')
                                    ? ($get('team_name') ?: 'A cégnév alapján')
                                    : 'Nem jön létre team'),
                            Placeholder::make('summary_members')
                                ->label('Tagok')
                                ->content(fn (Get $get): string => count($get('members') ?? []) . ' tag'),
                        ]),
                ])
                    ->columnSpanFull(),
            ])
            ->statePath('data');
    }

    public function create(): void
    {
        $data = $this->form->getState();

        $owner = app(CreateCustomerAction::class)->handle($data);

        Notification::make()
            ->success()
            ->title('Ügyfél létrehozva')
            ->body("{$owner->name} és a hozzá tartozó előfizetés(ek) elkészültek.")
            ->send();

        $this->redirect(UserResource::getUrl('edit', ['record' => $owner]), navigate: false);
    }
}
