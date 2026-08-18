<x-guest-layout>
    <h1 class="mb-2 font-serif text-2xl text-forest">Activate your account</h1>
    <p class="mb-4 text-sm text-forest/70">Welcome, {{ $user->name }}. Set a password to finish activating your tenant portal.</p>
    <form method="POST" action="{{ route('activation.store', $token) }}">
        @csrf
        <div>
            <x-input-label value="Password" />
            <x-text-input class="mt-1 block w-full" type="password" name="password" required />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>
        <div class="mt-4">
            <x-input-label value="Confirm password" />
            <x-text-input class="mt-1 block w-full" type="password" name="password_confirmation" required />
        </div>
        <div class="mt-6">
            <x-primary-button>Activate account</x-primary-button>
        </div>
    </form>
</x-guest-layout>
