@props(['variant' => 'contact', 'zelleHandle' => '@LLInternationalVentures'])

<div class="card p-5">
    <h2 class="label-caps">Pay your rent</h2>
    <p class="mt-1 text-sm text-forest/70">Choose your preferred payment method.</p>

    <div class="mt-4 rounded-xl border border-gray-100 bg-gray-50 p-4">
        <div class="flex items-center gap-2">
            <x-brand-zelle class="h-6 w-auto" />
            <p class="text-sm font-semibold">Pay with Zelle</p>
        </div>
        <p class="mt-2 text-sm font-semibold text-zelle">{{ $zelleHandle }}</p>
        <p class="mt-1 text-xs text-forest/60">Scan the code or search this username in your banking app.</p>
        @if ($variant === 'dashboard')
            <a href="{{ route('tenant.payments') }}" class="btn-primary mt-3 w-full text-xs">How to Pay with Zelle</a>
        @endif
    </div>

    <div class="my-3 flex items-center gap-3 text-xs font-semibold uppercase tracking-wide text-forest/40">
        <span class="h-px flex-1 bg-gray-200"></span> or <span class="h-px flex-1 bg-gray-200"></span>
    </div>

    @if ($variant === 'dashboard')
        <div class="rounded-xl border border-gray-100 bg-gray-50 p-4">
            <p class="text-sm font-semibold">Pay Online (Chase)</p>
            <p class="mt-1 text-xs text-forest/60">Card checkout will open in a later phase.</p>
            <span class="btn-outline mt-3 w-full cursor-not-allowed text-xs opacity-70">Pay Now with Chase</span>
        </div>
        <div class="my-3 flex items-center gap-3 text-xs font-semibold uppercase tracking-wide text-forest/40">
            <span class="h-px flex-1 bg-gray-200"></span> or <span class="h-px flex-1 bg-gray-200"></span>
        </div>
        <div class="rounded-xl border border-gray-100 bg-gray-50 p-4">
            <p class="text-sm font-semibold">Other Payment Options</p>
            <p class="mt-1 text-xs text-forest/60">Mail a check using the instructions on the payments page.</p>
            <a href="{{ route('tenant.payments') }}" class="btn-outline mt-3 w-full text-xs">View Instructions</a>
        </div>
    @else
        <div class="rounded-xl border border-gray-100 bg-gray-50 p-4">
            <p class="flex items-center gap-2 text-sm font-semibold"><x-icon name="card" class="h-5 w-5" /> Pay with Credit or Debit Card</p>
            <p class="mt-1 text-xs text-forest/60">Pay securely online using your credit or debit card.</p>
            <span class="btn-primary mt-3 w-full cursor-not-allowed text-xs opacity-80"><x-icon name="lock" class="h-4 w-4" /> Pay with Card</span>
            <div class="mt-3 flex flex-wrap items-center justify-center gap-2">
                <x-brand-cards />
            </div>
        </div>
    @endif

    <p class="mt-4 flex items-center gap-2 text-xs text-forest/50"><x-icon name="lock" class="h-3.5 w-3.5 text-gold" /> All payments are secure and encrypted.</p>
</div>
