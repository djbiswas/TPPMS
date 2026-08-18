<footer class="bg-forest text-white">
    <div class="grid gap-6 px-6 py-8 md:grid-cols-2 md:items-center">
        <div class="flex items-center gap-3">
            <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full border border-gold text-gold">
                <x-icon name="home" class="h-5 w-5" />
            </span>
            <div>
                <p class="text-sm font-semibold tracking-wide">L&amp;L INTERNATIONAL VENTURES LLC</p>
                <p class="text-sm text-white/90">Professional management. <span class="font-serif italic text-gold">Simple living.</span></p>
            </div>
        </div>
        <p class="flex items-center gap-2 text-sm text-white/80 md:justify-end md:border-l md:border-white/20 md:pl-8">
            <x-icon name="map" class="h-5 w-5 text-gold" />
            {{ $companyProperty?->fullAddress() ?? '317 Freedom Park, Liberty Hill, TX' }}
        </p>
    </div>
    <div class="flex flex-col gap-2 border-t border-white/10 bg-black/40 px-6 py-3 text-xs text-white/70 sm:flex-row sm:justify-between">
        <p class="flex items-center gap-2"><x-icon name="lock" class="h-3.5 w-3.5" /> Your information is secure and encrypted.</p>
        <p>&copy; {{ date('Y') }} L&amp;L International Ventures LLC. All rights reserved.</p>
    </div>
</footer>
