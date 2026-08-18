<x-layouts.portal title="Dashboard">
    <h1 class="font-serif text-4xl">Welcome Home!</h1>
    <p class="mt-2 text-forest/70">Here's an overview of your account.</p>
    <div class="mt-8 grid gap-6 lg:grid-cols-3">
        <div class="space-y-6 lg:col-span-2">
            <div class="rounded-2xl bg-white p-6 shadow-sm">
                <p class="text-sm uppercase tracking-wide text-gold">Pay rent</p>
                <p class="mt-2 text-forest/80">Use Zelle or the instructions on the payments page. Online card checkout is coming later.</p>
                <a href="{{ route('tenant.payments') }}" class="mt-4 inline-block rounded-lg bg-forest px-5 py-3 font-semibold text-white">Pay rent</a>
            </div>
            <div class="rounded-2xl bg-white p-6 shadow-sm">
                <div class="flex justify-between">
                    <h2 class="font-semibold">Recent requests</h2>
                    <a class="text-sm text-gold" href="{{ route('tenant.requests.index') }}">View all</a>
                </div>
                <ul class="mt-4 divide-y">
                    @forelse ($requests as $item)
                        <li class="flex justify-between py-3 text-sm">
                            <span>{{ $item->subject }}</span>
                            <span class="uppercase text-forest/60">{{ $item->status }}</span>
                        </li>
                    @empty
                        <li class="py-3 text-sm text-forest/60">No requests yet.</li>
                    @endforelse
                </ul>
            </div>
        </div>
        <div class="space-y-6">
            <div class="overflow-hidden rounded-2xl bg-white shadow-sm">
                <img src="{{ asset('images/property-hero.jpg') }}" class="h-40 w-full object-cover" alt="">
                <div class="p-4">
                    <p class="font-semibold">{{ $property?->fullAddress() }}</p>
                    <p class="text-sm text-forest/70">{{ $property?->type }}</p>
                </div>
            </div>
            <div class="rounded-2xl bg-white p-4 shadow-sm">
                <p class="text-sm font-bold tracking-wide">PROPERTY MANAGER</p>
                <p class="mt-2 font-semibold">{{ $property?->manager_name }}</p>
                <p class="text-sm">{{ $property?->manager_email }}</p>
                <p class="text-sm">{{ $property?->manager_phone }}</p>
            </div>
        </div>
    </div>
</x-layouts.portal>
