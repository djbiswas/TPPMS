<x-layouts.portal title="Dashboard">
    @php
        $amount = number_format((float) ($rentAmount ?? 2375), 2);
    @endphp
    <h1 class="font-serif text-4xl sm:text-5xl">Welcome Home!</h1>
    <div class="mt-3 h-px w-16 bg-gold"></div>
    <p class="mt-3 text-forest/70">Here's an overview of your account.</p>

    <div class="mt-8 grid gap-6 xl:grid-cols-3">
        <div class="space-y-6 xl:col-span-2">
            <div class="card p-5 sm:p-6">
                <div class="flex flex-wrap items-start justify-between gap-3">
                    <p class="label-caps text-forest/50">Current balance</p>
                    <span class="status-pill bg-[#e8d5b7] text-forest">Upcoming</span>
                </div>
                <p class="mt-2 font-serif text-4xl sm:text-5xl">${{ $amount }}</p>
                <p class="mt-2 text-sm text-forest/70">Due on {{ $dueDate }}</p>
                <a href="{{ route('tenant.payments') }}" class="btn-primary mt-6 w-full"><x-icon name="lock" class="h-4 w-4" /> Pay rent</a>
                <a href="{{ route('tenant.payments') }}" class="mt-3 block text-sm font-semibold text-forest">View payment options →</a>
            </div>

            <div class="card p-5 sm:p-6">
                <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
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
                <div class="mt-4 flex flex-wrap items-center justify-between gap-2 border-t border-cream pt-3 text-sm text-forest/60">
                    <span>Auto-pay is not set up</span>
                    <span class="font-semibold text-forest/40">Set up autopay →</span>
                </div>
            </div>

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
            <x-property-card :property="$property" />
            <x-pay-rent-card variant="dashboard" :zelle-handle="$zelleHandle" />
            <x-manager-card :property="$property" :show-hours="false" />
        </div>
    </div>
</x-layouts.portal>
