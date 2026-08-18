<x-layouts.portal title="Dashboard">
    @php
        $amount = number_format((float) ($rentAmount ?? 2375), 2);
    @endphp
    <h1 class="font-serif text-4xl sm:text-5xl">Welcome Home!</h1>
    <p class="mt-2 text-forest/70">Here's an overview of your account.</p>

    <div class="mt-8 grid gap-6 xl:grid-cols-3">
        <div class="space-y-6 xl:col-span-2">
            <div class="card p-5 sm:p-6">
                <div class="flex flex-wrap items-start justify-between gap-3">
                    <p class="label-caps text-forest/50">Current balance</p>
                    <span class="status-pill bg-[#e8d5b7] text-forest">Upcoming</span>
                </div>
                <p class="mt-2 font-serif text-4xl sm:text-5xl">${{ $amount }}</p>
                <p class="mt-2 text-sm text-forest/70">Due on {{ $dueDate }}</p>
                <a href="{{ route('tenant.payments') }}" class="btn-primary mt-6 w-full sm:w-auto"><x-icon name="lock" class="h-4 w-4" /> Pay rent</a>
                <a href="{{ route('tenant.payments') }}" class="mt-3 block text-sm font-semibold text-forest">View payment options →</a>
            </div>

            <div class="card flex flex-col gap-3 p-5 sm:flex-row sm:items-center sm:justify-between">
                <div class="flex items-center gap-3">
                    <span class="flex h-11 w-11 items-center justify-center rounded-full bg-cream"><x-icon name="calendar" class="h-5 w-5" /></span>
                    <div>
                        <p class="text-sm text-forest/60">Upcoming payment</p>
                        <p class="font-semibold">{{ $dueDate }}</p>
                    </div>
                </div>
                <div class="sm:text-right">
                    <p class="text-sm text-forest/60">Rent amount</p>
                    <p class="text-xl font-semibold">${{ $amount }}</p>
                </div>
            </div>
            <p class="text-sm text-forest/60">Auto-pay is not set up. <span class="text-forest/40">Coming in a later phase.</span></p>

            <div class="card p-5 sm:p-6">
                <p class="label-caps">Quick actions</p>
                <div class="mt-5 grid grid-cols-2 gap-4 sm:grid-cols-4">
                    <a href="{{ route('tenant.documents') }}" class="text-center text-sm">
                        <span class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-cream"><x-icon name="document" class="h-6 w-6" /></span>
                        <span class="mt-2 block">View Lease</span>
                    </a>
                    <a href="{{ route('contact') }}" class="text-center text-sm">
                        <span class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-cream"><x-icon name="wrench" class="h-6 w-6" /></span>
                        <span class="mt-2 block">Submit Maintenance Request</span>
                    </a>
                    <a href="{{ route('tenant.messages') }}" class="text-center text-sm">
                        <span class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-cream"><x-icon name="envelope" class="h-6 w-6" /></span>
                        <span class="mt-2 block">Send Message</span>
                    </a>
                    <a href="{{ route('tenant.profile.edit') }}" class="text-center text-sm">
                        <span class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-cream"><x-icon name="user" class="h-6 w-6" /></span>
                        <span class="mt-2 block">Update Profile</span>
                    </a>
                </div>
            </div>

            <div class="card p-5 sm:p-6">
                <div class="flex items-center justify-between">
                    <h2 class="font-semibold">Recent payment history</h2>
                    <a class="text-sm font-semibold text-gold-dark" href="{{ route('tenant.history') }}">View All</a>
                </div>
                <ul class="mt-4 divide-y">
                    @forelse ($history as $row)
                        <li class="flex flex-wrap items-center justify-between gap-2 py-3 text-sm">
                            <span>{{ $row['date'] }}</span>
                            <span class="status-pill bg-green-50 text-green-800">Paid</span>
                            <span class="font-semibold">${{ $row['amount'] }}</span>
                            <span class="flex items-center gap-1 text-forest/50"><x-icon name="download" class="h-4 w-4" /> Receipt</span>
                        </li>
                    @empty
                        <li class="py-6 text-sm text-forest/60">No payments recorded yet. After you pay, receipts will appear here.</li>
                    @endforelse
                </ul>
            </div>
        </div>

        <div class="space-y-6">
            <div class="card overflow-hidden">
                <img src="{{ asset('images/property-hero.jpg') }}" class="h-44 w-full object-cover" alt="Property">
                <div class="p-4">
                    <p class="font-semibold">{{ $property?->fullAddress() }}</p>
                    <p class="mt-1 flex items-center gap-2 text-sm text-forest/70"><x-icon name="home" class="h-4 w-4 text-gold" /> {{ $property?->type }}</p>
                </div>
            </div>
            <div class="card p-5">
                <h2 class="label-caps">Pay your rent</h2>
                <p class="mt-1 text-sm text-forest/70">Choose your preferred payment method.</p>
                <div class="mt-4 rounded-xl bg-gray-50 p-4">
                    <p class="text-sm font-semibold">Zelle</p>
                    <p class="text-zelle">{{ $zelleHandle }}</p>
                    <p class="mt-1 text-xs text-forest/60">Pay from your banking app.</p>
                    <a href="{{ route('tenant.payments') }}" class="btn-primary mt-3 w-full text-xs">How to Pay with Zelle</a>
                </div>
                <div class="my-3 flex items-center gap-3 text-xs uppercase tracking-wide text-forest/40"><span class="h-px flex-1 bg-gray-200"></span> or <span class="h-px flex-1 bg-gray-200"></span></div>
                <div class="rounded-xl bg-gray-50 p-4">
                    <p class="text-sm font-semibold">Pay securely online</p>
                    <p class="text-xs text-forest/60">Chase / card checkout coming later.</p>
                    <span class="btn-outline mt-3 w-full cursor-not-allowed text-xs opacity-60">Pay Now with Chase</span>
                </div>
                <div class="my-3 flex items-center gap-3 text-xs uppercase tracking-wide text-forest/40"><span class="h-px flex-1 bg-gray-200"></span> or <span class="h-px flex-1 bg-gray-200"></span></div>
                <div class="rounded-xl bg-gray-50 p-4">
                    <p class="flex items-center gap-2 text-sm font-semibold"><x-icon name="pencil" class="h-4 w-4" /> Other</p>
                    <p class="text-xs text-forest/60">Mail a check using the instructions on the payments page.</p>
                    <a href="{{ route('tenant.payments') }}" class="btn-outline mt-3 w-full text-xs">View Instructions</a>
                </div>
                <p class="mt-4 flex items-center gap-2 text-xs text-forest/50"><x-icon name="lock" class="h-3.5 w-3.5" /> All payments are secure and encrypted.</p>
            </div>
            <div class="card p-5">
                <p class="label-caps">Property manager</p>
                <p class="mt-3 flex items-center gap-2 font-semibold"><x-icon name="user" class="h-5 w-5 text-gold" /> {{ $property?->manager_name }}</p>
                <p class="text-sm">{{ $property?->manager_title }}</p>
                <p class="mt-2 flex items-center gap-2 break-all text-sm"><x-icon name="envelope" class="h-4 w-4 shrink-0 text-gold" /> {{ $property?->manager_email }}</p>
                <p class="flex items-center gap-2 text-sm"><x-icon name="phone" class="h-4 w-4 text-gold" /> {{ $property?->manager_phone }}</p>
            </div>
        </div>
    </div>
</x-layouts.portal>
