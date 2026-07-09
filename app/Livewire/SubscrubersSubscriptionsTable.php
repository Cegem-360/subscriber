<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Concerns\RequiresEmailVerification;
use App\Models\Subscription;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\HtmlString;
use Livewire\Component;

class SubscrubersSubscriptionsTable extends Component implements HasActions, HasSchemas, HasTable
{
    use InteractsWithActions;
    use InteractsWithSchemas;
    use InteractsWithTable;
    use RequiresEmailVerification;

    public function table(Table $table): Table
    {
        return $table
            ->query(fn (): Builder => Subscription::query())
            ->columns([
                TextColumn::make('user.name')
                    ->visible(fn (): bool => Auth::user()->isAdmin())
                    ->searchable(),
                TextColumn::make('plan.planCategory.name')
                    ->label('Module')
                    ->searchable(),
                TextColumn::make('plan.planCategory.url')
                    ->formatStateUsing(fn (string $state): HtmlString => new HtmlString("<a href=\"$state\" target=\"_blank\">$state</a>"))
                    ->label('Module url')
                    ->searchable(),
                TextColumn::make('plan.name')
                    ->searchable(),
                TextColumn::make('type')
                    ->badge()
                    ->searchable(),
                TextColumn::make('quantity')
                    ->label(__('Seats'))
                    ->numeric()
                    ->sortable(),
                TextColumn::make('next_billing_date')
                    ->label(__('Next billing date'))
                    ->state(fn (Subscription $record): ?string => $record->nextBillingDate()?->format('Y. m. d.'))
                    ->placeholder('—'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                //
            ])
            ->recordActions([
                Action::make('view')
                    ->label(__('View'))
                    ->icon('heroicon-o-eye')
                    ->url(fn (Subscription $record): string => route('subscription.view', $record)),
                Action::make('update')
                    ->label(__('Update'))
                    ->icon('heroicon-o-arrow-path')
                    ->url(fn (Subscription $record): string => route('subscription.update', $record))
                    ->visible(fn (Subscription $record): bool => $this->userEmailVerified() && $record->isActive()),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    //
                ]),
            ]);
    }

    public function render(): View
    {
        return view('livewire.subscrubers-subscriptions-table');
    }
}
