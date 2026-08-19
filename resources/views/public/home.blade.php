<x-layouts.public title="Welcome Home — L&L Tenant Portal">
    <section class="relative">
        <div class="relative min-h-[560px] sm:min-h-[640px]">
            <img src="{{ $siteHero ?? asset('images/property-hero.jpg') }}" alt="317 Freedom Park, Liberty Hill" class="absolute inset-0 h-full w-full object-cover object-center">
            <div class="absolute inset-0 bg-gradient-to-b from-cream via-cream/40 to-transparent"></div>
            <div class="relative z-10 mx-auto max-w-3xl px-4 pb-40 pt-28 text-center sm:pt-32">
                <h1 class="font-serif text-5xl text-forest sm:text-6xl md:text-7xl">Welcome Home.</h1>
                <div class="mx-auto mt-4 h-px w-24 bg-gold"></div>
                <p class="mx-auto mt-6 max-w-xl text-base text-forest sm:text-lg">
                    Your secure tenant portal for <strong>L&amp;L International Ventures LLC.</strong>
                </p>
                <p class="mx-auto mt-3 max-w-xl text-sm leading-relaxed text-forest/80 sm:text-base">
                    Access your rental account, make payments, view your lease, and manage your home securely and conveniently.
                </p>
            </div>
            <svg class="absolute bottom-[-1px] left-0 h-16 w-full text-white sm:h-24" viewBox="0 0 1440 80" preserveAspectRatio="none" aria-hidden="true">
                <path fill="currentColor" d="M0,48 C240,88 480,8 720,32 C960,56 1200,88 1440,40 L1440,80 L0,80 Z"></path>
            </svg>
        </div>

        <div class="relative z-20 mx-auto -mt-36 max-w-3xl px-4 sm:-mt-40">
            <div class="grid gap-5 text-left sm:grid-cols-2">
                <div class="card p-6">
                    <div class="flex h-14 w-14 items-center justify-center rounded-full bg-forest text-white ring-2 ring-gold ring-offset-2">
                        <x-icon name="user" class="h-6 w-6" />
                    </div>
                    <h2 class="mt-4 label-caps">Tenant login</h2>
                    <p class="mt-2 text-sm text-forest/70">Already have an account? Sign in to your tenant portal.</p>
                    <a href="{{ route('login') }}" class="btn-primary mt-5 w-full">
                        <x-icon name="lock" class="h-4 w-4" /> Sign in to my account
                    </a>
                </div>
                <div class="card p-6">
                    <div class="flex h-14 w-14 items-center justify-center rounded-full bg-forest text-white ring-2 ring-gold ring-offset-2">
                        <x-icon name="user-plus" class="h-6 w-6" />
                    </div>
                    <h2 class="mt-4 label-caps">New tenant?</h2>
                    <p class="mt-2 text-sm text-forest/70">Activate your account using the information provided by property management.</p>
                    <a href="{{ route('contact') }}" class="btn-outline mt-5 w-full">Activate my account</a>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-white px-4 pb-6 pt-16">
        <div class="mx-auto max-w-6xl py-6">
            <div class="flex items-center justify-center gap-4">
                <span class="h-px w-10 bg-gold sm:w-16"></span>
                <p class="label-caps text-center text-forest">Your tenant portal includes</p>
                <span class="h-px w-10 bg-gold sm:w-16"></span>
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
                        <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-cream text-gold">
                            <x-icon :name="$feature[0]" class="h-7 w-7" />
                        </div>
                        <h3 class="mt-4 label-caps">{{ $feature[1] }}</h3>
                        <p class="mt-2 text-sm text-forest/70">{{ $feature[2] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="bg-white px-4 pb-16">
        <div class="mx-auto flex max-w-6xl flex-col gap-8 rounded-2xl border border-gold/40 bg-cream p-6 sm:p-8 lg:flex-row lg:items-center lg:justify-between">
            <div class="flex items-start gap-4">
                <div class="flex h-16 w-16 shrink-0 items-center justify-center rounded-full bg-forest text-white">
                    <x-icon name="headset" class="h-8 w-8" />
                </div>
                <div>
                    <h2 class="label-caps">Need help accessing your account?</h2>
                    <p class="mt-2 max-w-md text-sm text-forest/70">If you have any questions or need assistance, please contact property management.</p>
                </div>
            </div>
            <div class="lg:border-l lg:border-gold lg:pl-8">
                <p class="flex items-center gap-2 font-semibold"><x-icon name="user" class="h-4 w-4 text-gold" /> {{ $companyProperty?->manager_name ?? 'Angie Ojeda' }}, Property Manager, L&amp;L International Ventures LLC.</p>
                <p class="mt-2 flex items-center gap-2 break-all text-sm"><x-icon name="envelope" class="h-4 w-4 shrink-0 text-gold" /> {{ $companyProperty?->manager_email ?? 'manager@llinternationalventures.com' }}</p>
                <p class="flex items-center gap-2 text-sm"><x-icon name="phone" class="h-4 w-4 text-gold" /> {{ $companyProperty?->manager_phone ?? '(512) 806-3630' }}</p>
            </div>
        </div>
    </section>
</x-layouts.public>
