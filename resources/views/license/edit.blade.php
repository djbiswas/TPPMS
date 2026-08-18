<x-layouts.admin title="License">
    @if (session('status'))<p class="mb-4">{{ session('status') }}</p>@endif
    <h1 class="font-serif text-3xl">WebFix Team license</h1>
    <p class="mt-2 text-sm text-forest/70">Product slug: {{ $item }} · Domain: {{ $domain }}</p>
    @if ($state)
        <p class="mt-4 text-sm">Status: {{ $state->status }} · Valid: {{ $state->valid ? 'yes' : 'no' }} · Checked: {{ $state->checked_at }}</p>
    @endif
    <form method="POST" action="{{ route('license.update') }}" class="mt-6 max-w-lg space-y-4 rounded-xl bg-white p-6 shadow-sm">
        @csrf
        <input name="key" placeholder="XXXX-XXXX-XXXX-XXXX" class="w-full rounded-lg border-gray-300" value="{{ config('webfix.key') }}">
        <button class="rounded-lg bg-forest px-4 py-2 text-white">Activate license</button>
    </form>
    <p class="mt-4 text-xs text-forest/60">Create the product and key in webfixteam admin. Do not change webfixteam code.</p>
</x-layouts.admin>
