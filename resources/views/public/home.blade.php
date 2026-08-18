<x-layouts.public title="Welcome Home — L&L Tenant Portal">
    <section class="relative overflow-hidden bg-cream">
        <div class="mx-auto grid max-w-6xl items-center gap-10 px-4 py-16 lg:grid-cols-2">
            <div>
                <h1 class="font-serif text-5xl text-forest md:text-6xl">Welcome Home.</h1>
                <p class="mt-4 text-lg font-semibold text-forest">Your secure tenant portal for L&L International Ventures LLC.</p>
                <p class="mt-3 max-w-xl text-forest/80">Access your rental account, make payments, view your lease, and manage your home securely and conveniently.</p>
                <div class="mt-10 grid gap-5 sm:grid-cols-2">
                    <div class="rounded-2xl bg-white p-6 shadow-sm">
                        <div class="flex h-12 w-12 items-center justify-center rounded-full bg-forest text-white">&#128100;</div>
                        <h2 class="mt-4 text-sm font-bold tracking-[0.16em]">TENANT LOGIN</h2>
                        <p class="mt-2 text-sm text-forest/70">Already have an account? Sign in to your tenant portal.</p>
                        <a href="{{ route('login') }}" class="mt-5 inline-flex w-full items-center justify-center rounded-lg bg-forest px-4 py-3 text-sm font-semibold text-white">Sign in to my account</a>
                    </div>
                    <div class="rounded-2xl bg-white p-6 shadow-sm">
                        <div class="flex h-12 w-12 items-center justify-center rounded-full bg-forest text-white">+</div>
                        <h2 class="mt-4 text-sm font-bold tracking-[0.16em]">NEW TENANT?</h2>
                        <p class="mt-2 text-sm text-forest/70">Activate your account using the information provided by property management.</p>
                        <a href="{{ route('contact') }}" class="mt-5 inline-flex w-full items-center justify-center rounded-lg border border-forest px-4 py-3 text-sm font-semibold text-forest">Activate my account</a>
                    </div>
                </div>
            </div>
            <div class="min-h-[320px] overflow-hidden rounded-3xl shadow-lg">
                <img src="{{ asset('images/property-hero.jpg') }}" alt="Managed property" class="h-full w-full object-cover">
            </div>
        </div>
    </section>

    <section class="mx-auto max-w-6xl px-4 py-16">
        <p class="text-center text-xs font-semibold tracking-[0.22em] text-forest/70">YOUR TENANT PORTAL INCLUDES</p>
        <div class="mt-10 grid gap-8 sm:grid-cols-2 lg:grid-cols-5">
            @foreach ([
                ['Secure Payments', 'Make rent payments safely and securely online.'],
                ['Lease Documents', 'View and download your lease and important rental documents.'],
                ['Maintenance', 'Submit maintenance requests and track their status.'],
                ['Payment History', 'View your payment history and download receipts.'],
                ['Messages', 'Receive important messages from property management.'],
            ] as $feature)
                <div class="text-center">
                    <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-cream"></div>
                    <h3 class="mt-4 font-semibold">{{ $feature[0] }}</h3>
                    <p class="mt-2 text-sm text-forest/70">{{ $feature[1] }}</p>
                </div>
            @endforeach
        </div>
        <p class="mt-8 text-center text-sm text-gold">Payment history, lease files, and messages expand in a later phase. Maintenance and payments instructions are available now.</p>
    </section>

    <section class="mx-auto max-w-6xl px-4 pb-8">
        <div class="rounded-2xl border border-gray-200 bg-gray-50 p-8 md:flex md:items-center md:justify-between">
            <div>
                <h2 class="text-sm font-bold tracking-[0.16em]">NEED HELP ACCESSING YOUR ACCOUNT?</h2>
                <p class="mt-2 text-sm text-forest/70">If you have questions or need assistance, please contact property management.</p>
            </div>
            <div class="mt-6 md:mt-0 md:border-l md:pl-8">
                <p class="font-semibold">{{ $companyProperty->manager_name ?? 'Angie Ojeda' }}</p>
                <p class="text-sm">Property Manager, L&L International Ventures LLC</p>
                <p class="mt-2 text-sm">{{ $companyProperty->manager_email ?? 'manager@llinternationalventures.com' }}</p>
                <p class="text-sm">{{ $companyProperty->manager_phone ?? '(512) 806-3630' }}</p>
            </div>
        </div>
    </section>

    <section class="mx-auto max-w-6xl px-4 pb-16">
        <div class="rounded-2xl bg-white p-8 shadow-sm ring-1 ring-gray-100">
            <h2 class="text-sm font-bold tracking-[0.16em]">PAY WITH ZELLE</h2>
            <p class="mt-2 text-2xl font-semibold text-zelle">{{ $zelleHandle }}</p>
            <p class="mt-2 text-sm text-forest/70">Scan or search this username in your banking app. Wire instructions are available after you sign in.</p>
            <a href="{{ route('contact') }}" class="mt-4 inline-block text-sm font-semibold text-forest underline">Contact us or submit a request</a>
        </div>
    </section>
</x-layouts.public>
