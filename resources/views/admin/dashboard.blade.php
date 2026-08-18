<x-layouts.admin title="Admin dashboard">
    <h1 class="font-serif text-3xl">Operations</h1>
    <div class="mt-6 grid gap-4 sm:grid-cols-3">
        <div class="rounded-xl bg-white p-5 shadow-sm"><p class="text-sm text-forest/60">New requests</p><p class="text-3xl font-semibold">{{ $newCount }}</p></div>
        <div class="rounded-xl bg-white p-5 shadow-sm"><p class="text-sm text-forest/60">In review</p><p class="text-3xl font-semibold">{{ $reviewCount }}</p></div>
        <div class="rounded-xl bg-white p-5 shadow-sm"><p class="text-sm text-forest/60">Tenants</p><p class="text-3xl font-semibold">{{ $tenantCount }}</p></div>
    </div>
    <div class="mt-8 rounded-xl bg-white p-5 shadow-sm">
        <h2 class="font-semibold">Recent requests</h2>
        <ul class="mt-3 divide-y text-sm">
            @foreach ($recent as $item)
                <li class="flex justify-between py-2">
                    <a href="{{ route('admin.requests.show', $item) }}">{{ $item->subject }}</a>
                    <span>{{ $item->status }}</span>
                </li>
            @endforeach
        </ul>
    </div>
</x-layouts.admin>
