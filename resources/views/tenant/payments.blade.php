<x-layouts.portal title="Pay rent">
    <h1 class="font-serif text-3xl">Rent & Payments</h1>
    <div class="mt-6 max-w-xl space-y-4 rounded-2xl bg-white p-6 shadow-sm">
        <p class="font-semibold">Zelle</p>
        <p class="text-xl text-zelle">{{ $zelle }}</p>
        <p class="text-sm text-forest/70">Pay from your banking app using this username.</p>
        @if ($wire)
            <hr>
            <p class="font-semibold">Wire / bank instructions</p>
            <p class="whitespace-pre-line text-sm">{{ $wire }}</p>
        @endif
    </div>
</x-layouts.portal>
