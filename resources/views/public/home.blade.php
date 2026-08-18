<x-layouts.public title="Welcome Home — L&L Tenant Portal">
    <section class="relative overflow-hidden">
        <img src="{{ asset('images/property-hero.jpg') }}" alt="" class="absolute inset-0 h-full w-full scale-105 object-cover blur-[2px]">
        <div class="absolute inset-0 bg-white/80"></div>
        <div class="relative mx-auto max-w-4xl px-4 py-16 text-center sm:py-20">
            <h1 class="font-serif text-5xl text-forest sm:text-6xl md:text-7xl">Welcome Home.</h1>
            <p class="mx-auto mt-5 max-w-2xl text-base font-medium text-forest sm:text-lg">
                Your secure tenant portal for <strong>L&amp;L International Ventures LLC.</strong>
                Access your rental account, make payments, view your lease, and manage your home securely and conveniently.
            </p>
            <div class="mx-auto mt-10 grid max-w-3xl gap-5 sm:grid-cols-2">
                <div class="card p-6 text-left">
                    <div class="flex h-12 w-12 items-center justify-center rounded-full bg-forest text-white">
                        <x-icon name="user" class="h-6 w-6" />
                    </div>
                    <h2 class="mt-4 label-caps">Tenant login</h2>
                    <p class="mt-2 text-sm text-forest/70">Already have an account? Sign in to your tenant portal.</p>
                    <a href="{{ route('login') }}" class="btn-primary mt-5 w-full">
                        <x-icon name="lock" class="h-4 w-4" /> Sign in to my account
                    </a>
                </div>
                <div class="card p-6 text-left">
                    <div class="flex h-12 w-12 items-center justify-center rounded-full bg-gold text-white">
                        <x-icon name="user-plus" class="h-6 w-6" />
                    </div>
                    <h2 class="mt-4 label-caps">New tenant?</h2>
                    <p class="mt-2 text-sm text-forest/70">Activate your account using the information provided by property management.</p>
                    <a href="{{ route('contact') }}" class="btn-outline mt-5 w-full">Activate my account</a>
                </div>
            </div>
        </div>
    </section>

    <section class="mx-auto max-w-6xl px-4 py-16">
        <div class="flex items-center justify-center gap-4">
            <span class="hidden h-px w-16 bg-gold sm:block"></span>
            <p class="label-caps text-center text-forest/70">Your tenant portal includes</p>
            <span class="hidden h-px w-16 bg-gold sm:block"></span>
        </div>
        <div class="mt-10 grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-5">
            @foreach ([
                ['card', 'Secure Payments', 'Make rent payments safely and securely online.'],
                ['document', 'Lease Documents', 'View and download your lease and important rental documents.'],
                ['wrench', 'Maintenance', 'Submit maintenance requests and track their status.'],
                ['clock', 'Payment History', 'View your payment history and download receipts.'],
                ['envelope', 'Messages', 'Receive important messages from property management.'],
            ] as $feature)
                <div class="text-center">
                    <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-cream text-forest">
                        <x-icon :name="$feature[0]" class="h-7 w-7" />
                    </div>
                    <h3 class="mt-4 font-semibold">{{ $feature[1] }}</h3>
                    <p class="mt-2 text-sm text-forest/70">{{ $feature[2] }}</p>
                </div>
            @endforeach
        </div>
    </section>

    <section class="mx-auto max-w-6xl px-4 pb-16">
        <div class="flex flex-col gap-8 rounded-2xl border border-gray-200 bg-gray-50 p-6 sm:p-8 lg:flex-row lg:items-center lg:justify-between">
            <div class="flex items-start gap-4">
                <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-full bg-forest text-white">
                    <x-icon name="headset" class="h-7 w-7" />
                </div>
                <div>
                    <h2 class="label-caps">Need help accessing your account?</h2>
                    <p class="mt-2 max-w-md text-sm text-forest/70">If you have any questions or need assistance, please contact property management.</p>
                </div>
            </div>
            <div class="lg:border-l lg:border-gray-200 lg:pl-8">
                <p class="flex items-center gap-2 font-semibold"><x-icon name="user" class="h-4 w-4 text-gold" /> {{ $companyProperty->manager_name ?? 'Angie Ojeda' }}</p>
                <p class="text-sm text-forest/70">Property Manager, L&amp;L International Ventures LLC</p>
                <p class="mt-2 flex items-center gap-2 break-all text-sm"><x-icon name="envelope" class="h-4 w-4 shrink-0 text-gold" /> {{ $companyProperty->manager_email ?? 'manager@llinternationalventures.com' }}</p>
                <p class="flex items-center gap-2 text-sm"><x-icon name="phone" class="h-4 w-4 text-gold" /> {{ $companyProperty->manager_phone ?? '(512) 806-3630' }}</p>
            </div>
        </div>
    </section>
</x-layouts.public>
