@auth
    @if (!auth()->user()->hasVerifiedEmail())
        <div class="w-full bg-amber-50 dark:bg-amber-950/40 border-b border-amber-200 dark:border-amber-800">
            <div class="mx-auto flex max-w-7xl flex-col gap-2 px-4 py-3 sm:flex-row sm:items-center sm:justify-between">
                <div class="flex items-start gap-2 text-sm text-amber-800 dark:text-amber-200">
                    <svg class="mt-0.5 h-5 w-5 shrink-0" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd"
                            d="M8.485 2.495c.673-1.167 2.357-1.167 3.03 0l6.28 10.875c.673 1.167-.17 2.625-1.516 2.625H3.72c-1.347 0-2.189-1.458-1.515-2.625L8.485 2.495zM10 5a.75.75 0 01.75.75v3.5a.75.75 0 01-1.5 0v-3.5A.75.75 0 0110 5zm0 9a1 1 0 100-2 1 1 0 000 2z"
                            clip-rule="evenodd" />
                    </svg>
                    <span>
                        <strong class="font-semibold">{{ __('Your email address is not verified.') }}</strong>
                        {{ __('You can browse, but actions are disabled until you verify it.') }}
                    </span>
                </div>

                <div class="flex shrink-0 items-center gap-2">
                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <button type="submit"
                            class="inline-flex items-center rounded-lg bg-amber-600 px-3 py-1.5 text-sm font-medium text-white transition hover:bg-amber-700 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2 dark:focus:ring-offset-amber-950">
                            {{ __('Resend verification email') }}
                        </button>
                    </form>

                    <form method="POST" action="{{ route('filament.admin.auth.logout') }}">
                        @csrf
                        <button type="submit"
                            class="inline-flex items-center rounded-lg border border-amber-300 bg-white px-3 py-1.5 text-sm font-medium text-amber-800 transition hover:bg-amber-100 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2 dark:border-amber-700 dark:bg-transparent dark:text-amber-200 dark:hover:bg-amber-900/40 dark:focus:ring-offset-amber-950">
                            {{ __('Log out') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @endif
@endauth
