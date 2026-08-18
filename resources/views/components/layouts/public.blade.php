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
    <header class="border-b border-cream bg-white">
        <div class="mx-auto flex max-w-6xl items-center justify-between px-4 py-4">
            <a href="{{ route('home') }}" class="flex items-center gap-3">
                <x-application-logo class="h-12 w-12" />
                <div>
                    <p class="text-xs font-semibold tracking-[0.18em] text-forest">L&L INTERNATIONAL</p>
                    <p class="text-[11px] tracking-[0.22em] text-gold">VENTURES LLC</p>
                </div>
            </a>
            <a href="{{ route('login') }}" class="flex items-center gap-2 text-xs font-semibold tracking-[0.18em] text-forest">
                TENANT PORTAL
            </a>
        </div>
    </header>
    <main>{{ $slot }}</main>
    <footer class="mt-16 bg-forest text-white">
        <div class="mx-auto flex max-w-6xl flex-col gap-6 px-4 py-10 md:flex-row md:items-center md:justify-between">
            <div>
                <p class="font-semibold tracking-wide">L&L International Ventures LLC</p>
                <p class="mt-1 font-serif italic text-gold">Professional management. Simple living.</p>
            </div>
            <p class="text-sm text-white/80">{{ $companyProperty?->fullAddress() ?? '317 Freedom Park, Liberty Hill, TX' }}</p>
        </div>
        <div class="border-t border-white/10 bg-black px-4 py-3 text-xs text-white/70">
            <div class="mx-auto flex max-w-6xl flex-col gap-2 sm:flex-row sm:justify-between">
                <p>Your information is secure and encrypted.</p>
                <p>&copy; {{ date('Y') }} L&L International Ventures LLC. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html>
