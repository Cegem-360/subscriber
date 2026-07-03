<?php

declare(strict_types=1);

namespace App\Filament\Pages;

use BackedEnum;
use Filament\Pages\Page;
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
        // Wizard steps added in Task 5.
        return $schema
            ->components([])
            ->statePath('data');
    }

    public function create(): void
    {
        // Implemented in Task 5.
    }
}
