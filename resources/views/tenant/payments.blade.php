<x-layouts.portal title="Pay rent">
    <h1 class="font-serif text-3xl">Rent &amp; Payments</h1>
    <div class="mt-6 grid gap-6 lg:grid-cols-2">
        <div class="card p-6">
            <p class="label-caps">Zelle</p>
            <p class="mt-3 text-2xl font-semibold text-zelle">{{ $zelle }}</p>
            <p class="mt-2 text-sm text-forest/70">Open your banking app, choose Zelle, and search this username. Include your unit or address in the memo.</p>
        </div>
        <div class="card p-6">
            <p class="label-caps">Wire / bank</p>
            <p class="mt-3 whitespace-pre-line text-sm">{{ $wire ?: 'Wire details are provided by property management after you sign in.' }}</p>
        </div>
    </div>
    <p class="mt-6 flex items-center gap-2 text-xs text-forest/50"><x-icon name="lock" class="h-4 w-4" /> We never store card or bank login details in this portal.</p>
</x-layouts.portal>
