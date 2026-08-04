<x-layouts.app>
    <div class="min-h-screen flex items-center justify-center bg-gray-100">
        <div class="max-w-md w-full bg-white rounded-lg shadow-md p-8">
            <h2 class="text-2xl font-bold text-center mb-2">Authorization Request</h2>
            <p class="text-sm text-gray-600 text-center mb-6">
                <strong>{{ $client->name }}</strong> is requesting access to your account
                ({{ $user->email }}).
            </p>

            @if ($scopes !== [])
                <div class="mb-6">
                    <p class="text-sm font-medium text-gray-700 mb-2">This will allow {{ $client->name }} to:</p>
                    <ul class="list-disc list-inside text-sm text-gray-600 space-y-1">
                        @foreach ($scopes as $scope)
                            <li>{{ $scope->description }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="flex gap-4">
                <form method="POST" action="{{ route('passport.authorizations.approve') }}" class="w-full">
                    @csrf
                    <input type="hidden" name="auth_token" value="{{ $authToken }}">
                    <button type="submit"
                        class="w-full bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 transition">
                        Authorize
                    </button>
                </form>

                <form method="POST" action="{{ route('passport.authorizations.deny') }}" class="w-full">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="auth_token" value="{{ $authToken }}">
                    <button type="submit"
                        class="w-full bg-gray-200 text-gray-800 py-2 px-4 rounded-md hover:bg-gray-300 transition">
                        Cancel
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-layouts.app>
