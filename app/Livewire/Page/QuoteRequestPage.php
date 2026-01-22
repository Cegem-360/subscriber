<?php

declare(strict_types=1);

namespace App\Livewire\Page;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
final class QuoteRequestPage extends Component implements HasSchemas
{
    use InteractsWithSchemas;

    public ?array $data = [];

    public bool $submitted = false;

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->schema([
                        TextInput::make('name')
                            ->label('Név')
                            ->required()
                            ->minLength(2)
                            ->maxLength(255)
                            ->placeholder('Az Ön neve'),

                        TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->required()
                            ->maxLength(255)
                            ->placeholder('pelda@email.hu'),

                        Textarea::make('message')
                            ->label('Üzenet')
                            ->required()
                            ->minLength(10)
                            ->maxLength(2000)
                            ->rows(5)
                            ->placeholder('Írja le igényeit, kérdéseit...'),
                    ])
                    ->columns(1),
            ])
            ->statePath('data');
    }

    public function submit(): void
    {
        $data = $this->form->getState();

        // TODO: Send email notification or store in database
        // Mail::to(config('mail.admin_address'))->send(new QuoteRequestMail($data));

        Notification::make()
            ->title('Köszönjük megkeresését!')
            ->body('Munkatársunk hamarosan felveszi Önnel a kapcsolatot.')
            ->success()
            ->send();

        $this->submitted = true;
        $this->form->fill();
    }

    public function render(): View
    {
        return view('livewire.quote-request-page');
    }
}
