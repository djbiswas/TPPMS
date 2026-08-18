<x-layouts.admin title="Admin dashboard">
    <h1 class="font-serif text-3xl">Operations</h1>
    <div class="mt-6 grid gap-4 sm:grid-cols-3">
        <div class="card p-5"><p class="text-sm text-forest/60">New requests</p><p class="font-serif text-3xl">{{ $newCount }}</p></div>
        <div class="card p-5"><p class="text-sm text-forest/60">In review</p><p class="font-serif text-3xl">{{ $reviewCount }}</p></div>
        <div class="card p-5"><p class="text-sm text-forest/60">Tenants</p><p class="font-serif text-3xl">{{ $tenantCount }}</p></div>
    </div>
    <div class="card mt-8 p-5">
        <h2 class="font-semibold">Recent requests</h2>
        <ul class="mt-3 divide-y text-sm">
            @foreach ($recent as $item)
                <li class="flex justify-between py-2">
                    <a class="font-medium" href="{{ route('admin.requests.show', $item) }}">{{ $item->subject }}</a>
                    <span class="status-pill bg-cream">{{ $item->status }}</span>
                </li>
            @endforeach
        </ul>
    </div>
</x-layouts.admin>
