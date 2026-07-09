<?php

declare(strict_types=1);

namespace App\Filament\Pages;

use App\Models\Setting;
use BackedEnum;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\Auth;
use Override;
use UnitEnum;

final class Settings extends Page
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCog6Tooth;

    protected static ?string $slug = 'settings';

    protected static ?string $navigationLabel = 'Beállítások';

    protected static ?string $title = 'Rendszerbeállítások';

    protected static string|UnitEnum|null $navigationGroup = 'Beállítások';

    protected static ?int $navigationSort = 5;

    protected string $view = 'filament.pages.settings';

    public ?array $data = [];

    #[Override]
    public static function shouldRegisterNavigation(): bool
    {
        return Auth::user()?->isAdmin() ?? false;
    }

    public function mount(): void
    {
        $this->form->fill([
            'eur_rate' => Setting::get('eur_rate', 400),
            'monthly_markup' => Setting::get('monthly_markup', 1.20),
        ]);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Pénznem beállítások')
                    ->description('EUR/HUF árfolyam és árszorzók kezelése')
                    ->schema([
                        TextInput::make('eur_rate')
                            ->label('EUR árfolyam (HUF)')
                            ->helperText('1 EUR hány forintot ér')
                            ->numeric()
                            ->required()
                            ->minValue(1)
                            ->default(400),

                        TextInput::make('monthly_markup')
                            ->label('Havi felár szorzó')
                            ->helperText('Havi ár = (éves ár / 12) * szorzó. Pl. 1.20 = 20% felár')
                            ->numeric()
                            ->required()
                            ->minValue(1)
                            ->step(0.01)
                            ->default(1.20),
                    ])
                    ->columns(2),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();

        Setting::set('eur_rate', $data['eur_rate']);
        Setting::set('monthly_markup', $data['monthly_markup']);

        Notification::make()
            ->success()
            ->title('Beállítások mentve')
            ->send();
    }
}
