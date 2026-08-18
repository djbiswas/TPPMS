<x-guest-layout>
    <h1 class="mb-4 font-serif text-2xl text-forest">Sign in</h1>
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div>
            <x-input-label for="email" value="Email" />
            <x-text-input id="email" class="mt-1 block w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
        <div class="mt-4">
            <x-input-label for="password" value="Password" />
            <x-text-input id="password" class="mt-1 block w-full" type="password" name="password" required />
        </div>
        <label class="mt-4 inline-flex items-center">
            <input type="checkbox" name="remember" class="rounded border-gray-300">
            <span class="ms-2 text-sm">Remember me</span>
        </label>
        <div class="mt-6 flex items-center justify-between">
            @if (Route::has('password.request'))
                <a class="text-sm text-forest underline" href="{{ route('password.request') }}">Forgot password?</a>
            @endif
            <x-primary-button>Sign in</x-primary-button>
        </div>
    </form>
</x-guest-layout>
