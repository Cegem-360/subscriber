<div class="w-full">
    <div class="mb-5">
        <h1 class="text-2xl font-semibold text-gray-900">
            Üdvözlünk a Cégem360-ban
        </h1>
        <p class="mt-2 text-base text-gray-500">
            Kezdd el ingyen - nincs szükség bankkártyára.
        </p>
    </div>

    <form wire:submit="register" class="space-y-4">
        {{ $this->form }}

        <div class="pt-1">
            <x-filament::button type="submit" color="primary" class="w-full! justify-center">
                Folytatás
            </x-filament::button>
        </div>

        <p class="text-center text-xs text-gray-500">
            A folytatással elfogadod az
            <a href="#" class="underline" style="color: #4f46e5 !important;">ÁSZF-et</a>
            és az
            <a href="#" class="underline" style="color: #4f46e5 !important;">Adatvédelmi Szabályzatot</a>.
        </p>

        <p class="text-center text-sm text-gray-500 pt-2">
            Van már fiókod?
            <a href="{{ route('filament.admin.auth.login') }}" class="font-medium" style="color: #4f46e5 !important;">
                Bejelentkezés
            </a>
        </p>
    </form>
</div>
