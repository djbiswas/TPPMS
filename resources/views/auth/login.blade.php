<x-guest-layout>
    <h1 class="mb-1 text-center font-serif text-3xl text-forest">Sign in</h1>
    <p class="mb-6 text-center text-sm text-forest/70">Tenant portal for L&amp;L International Ventures LLC</p>
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
            <input type="checkbox" name="remember" class="rounded border-gray-300 text-forest">
            <span class="ms-2 text-sm">Remember me</span>
        </label>
        <button class="btn-primary mt-6 w-full"><x-icon name="lock" class="h-4 w-4" /> Sign in to my account</button>
        @if (Route::has('password.request'))
            <p class="mt-4 text-center"><a class="text-sm text-forest underline" href="{{ route('password.request') }}">Forgot password?</a></p>
        @endif
    </form>
</x-guest-layout>
