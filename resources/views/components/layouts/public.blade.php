@props(['title' => null, 'metaDescription' => null, 'ogImage' => null])
@php
    $pageTitle = $title ?? ($siteMetaTitle ?? 'L&L International Ventures LLC');
    $desc = $metaDescription ?? ($siteMetaDescription ?? '');
    $og = $ogImage ?? ($siteOgImage ?? null);
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $pageTitle }}</title>
    @if ($desc)
        <meta name="description" content="{{ $desc }}">
    @endif
    @if (!empty($siteMetaKeywords))
        <meta name="keywords" content="{{ $siteMetaKeywords }}">
    @endif
    @if (!empty($siteFavicon))
        <link rel="icon" href="{{ $siteFavicon }}">
        <link rel="apple-touch-icon" href="{{ $siteFavicon }}">
    @endif
    <meta property="og:title" content="{{ $pageTitle }}">
    @if ($desc)
        <meta property="og:description" content="{{ $desc }}">
    @endif
    @if ($og)
        <meta property="og:image" content="{{ $og }}">
    @endif
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700|playfair-display:600,700" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-canvas font-sans text-forest antialiased">
    <header class="{{ request()->routeIs('home') ? 'absolute inset-x-0 top-0 z-20 bg-gradient-to-b from-cream via-cream/90 to-transparent' : 'relative border-b border-cream bg-white' }}">
        <div class="mx-auto flex max-w-6xl items-center justify-between px-4 py-4">
            <a href="{{ route('home') }}" class="flex items-center gap-4">
                <x-application-logo class="h-11 w-[4.6rem] shrink-0" />
                <span class="hidden h-8 w-px bg-gold sm:block"></span>
                <p class="hidden font-serif text-xs tracking-[0.14em] text-forest sm:block md:text-sm">{{ strtoupper($siteName ?? 'L&L INTERNATIONAL VENTURES LLC') }}</p>
            </a>
            <a href="{{ route('login') }}" class="flex items-center gap-2 text-[11px] font-semibold tracking-[0.18em] text-forest">
                <span class="flex h-8 w-8 items-center justify-center rounded-full border border-gold text-gold">
                    <x-icon name="lock" class="h-4 w-4" />
                </span>
                TENANT PORTAL
            </a>
        </div>
    </header>
    <main>{{ $slot }}</main>
    <footer class="bg-forest text-white">
        <div class="mx-auto flex max-w-6xl flex-col gap-6 px-4 py-10 md:flex-row md:items-center md:justify-between">
            <div class="flex items-center gap-3">
                <span class="flex h-11 w-11 items-center justify-center rounded-full border border-gold text-gold">
                    <x-icon name="home" class="h-5 w-5" />
                </span>
                <div>
                    <p class="text-sm font-semibold tracking-[0.12em]">{{ strtoupper($siteName ?? 'L&L INTERNATIONAL VENTURES LLC') }}</p>
                    <p class="font-serif italic text-gold">{{ $siteTagline ?? 'Professional management. Simple living.' }}</p>
                </div>
            </div>
            <p class="flex items-center gap-2 text-sm text-white/85 md:border-l md:border-white/25 md:pl-8">
                <x-icon name="map" class="h-5 w-5 text-gold" />
                {{ $companyProperty?->fullAddress() ?? '317 Freedom Park, Liberty Hill, TX' }}
            </p>
        </div>
        <div class="border-t border-white/15 px-4 py-3 text-xs text-white/70">
            <div class="mx-auto flex max-w-6xl flex-col gap-2 sm:flex-row sm:justify-between">
                <p class="flex items-center gap-2"><x-icon name="lock" class="h-3.5 w-3.5" /> Your information is secure and encrypted.</p>
                <p>
                    <a class="underline" href="{{ route('privacy') }}">Privacy</a>
                    ·
                    <a class="underline" href="{{ route('terms') }}">Terms</a>
                    ·
                    &copy; {{ date('Y') }} {{ $siteName ?? 'L&L International Ventures LLC' }}. All rights reserved.
                </p>
            </div>
        </div>
    </footer>
</body>
</html>
