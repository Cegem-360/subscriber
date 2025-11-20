<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\Subscription;
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
                TextColumn::make('ends_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                //
            ])
            ->recordActions([
                //
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
