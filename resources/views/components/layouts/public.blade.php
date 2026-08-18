<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'L&L International Ventures LLC' }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700|playfair-display:600,700" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-white font-sans text-forest antialiased">
    <header class="border-b border-cream/80 bg-white">
        <div class="mx-auto flex max-w-6xl items-center justify-between px-4 py-4">
            <a href="{{ route('home') }}" class="flex items-center gap-3">
                <x-application-logo class="h-12 w-12" />
                <div>
                    <p class="text-[11px] font-semibold tracking-[0.2em] text-forest">L&amp;L INTERNATIONAL</p>
                    <p class="text-[10px] tracking-[0.28em] text-gold">VENTURES LLC</p>
                </div>
            </a>
            <div class="flex items-center gap-5">
                <a href="{{ route('contact') }}" class="hidden text-xs font-semibold tracking-[0.14em] text-forest/70 hover:text-forest sm:inline">CONTACT</a>
                <a href="{{ route('login') }}" class="flex items-center gap-2 text-xs font-semibold tracking-[0.18em] text-forest">
                    <x-icon name="lock" class="h-4 w-4 text-gold" />
                    TENANT PORTAL
                </a>
            </div>
        </div>
    </header>
    <main>{{ $slot }}</main>
    <footer class="mt-16 bg-forest text-white">
        <div class="mx-auto flex max-w-6xl flex-col gap-6 px-4 py-10 md:flex-row md:items-center md:justify-between">
            <div class="flex items-center gap-3">
                <span class="flex h-10 w-10 items-center justify-center rounded-full border border-gold/60 text-gold">
                    <x-icon name="home" class="h-5 w-5" />
                </span>
                <div>
                    <p class="font-semibold tracking-wide">L&amp;L International Ventures LLC</p>
                    <p class="font-serif italic text-gold">Professional management. Simple living.</p>
                </div>
            </div>
            <p class="flex items-center gap-2 text-sm text-white/80">
                <x-icon name="map" class="h-5 w-5 text-gold" />
                {{ $companyProperty?->fullAddress() ?? '317 Freedom Park, Liberty Hill, TX' }}
            </p>
        </div>
        <div class="bg-black px-4 py-3 text-xs text-white/70">
            <div class="mx-auto flex max-w-6xl flex-col gap-2 sm:flex-row sm:justify-between">
                <p class="flex items-center gap-2"><x-icon name="lock" class="h-3.5 w-3.5 text-gold" /> Your information is secure and encrypted.</p>
                <p>&copy; {{ date('Y') }} L&amp;L International Ventures LLC. All rights reserved. · <a class="underline" href="{{ route('privacy') }}">Privacy</a> · <a class="underline" href="{{ route('terms') }}">Terms</a></p>
            </div>
        </div>
    </footer>
</body>
</html>
