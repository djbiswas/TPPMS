<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name') }}</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700|playfair-display:600,700" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-forest antialiased">
        <div class="relative flex min-h-screen flex-col items-center justify-center bg-cream px-4 py-10">
            <img src="{{ $siteHero ?? asset('images/property-hero.jpg') }}" alt="" class="pointer-events-none absolute inset-0 h-full w-full object-cover opacity-20">
            <div class="relative w-full max-w-md">
                <a href="{{ route('home') }}" class="mb-6 flex items-center justify-center">
                    <x-application-logo variant="full" class="h-52 w-auto max-w-[18rem]" />
                </a>
                <div class="card overflow-hidden px-6 py-8">
                    {{ $slot }}
                </div>
                <p class="mt-6 text-center text-xs text-forest/60">
                    <a href="{{ route('home') }}" class="underline">Back to homepage</a>
                </p>
            </div>
        </div>
    </body>
</html>
