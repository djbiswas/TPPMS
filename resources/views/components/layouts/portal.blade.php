@props(['title' => 'Tenant Portal'])
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title }} — L&amp;L Tenant Portal</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700|playfair-display:600,700" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-canvas font-sans text-forest" x-data="{ open: false }">
    <header class="sticky top-0 z-30 flex items-center justify-between border-b border-cream bg-white px-4 py-3 md:px-6">
        <div class="flex items-center gap-3">
            <button class="rounded-lg p-2 md:hidden" type="button" @click="open = true" aria-label="Open menu">
                <x-icon name="menu" class="h-6 w-6" />
            </button>
            <a href="{{ route('tenant.dashboard') }}" class="flex items-center">
                <x-application-logo class="h-14 w-auto max-w-[11rem] shrink-0 sm:h-16 sm:max-w-[13rem]" />
            </a>
        </div>
        <div class="flex items-center gap-4">
            <span class="relative text-forest/60">
                <x-icon name="bell" class="h-5 w-5" />
                <span class="absolute -right-1 -top-1 flex h-4 w-4 items-center justify-center rounded-full bg-red-500 text-[10px] font-bold text-white">1</span>
            </span>
            <div class="flex items-center gap-2">
                <span class="hidden text-sm sm:inline">Welcome back, <span class="font-semibold">{{ auth()->user()->name }}</span></span>
                <span class="flex h-9 w-9 items-center justify-center rounded-full bg-cream text-forest"><x-icon name="user" class="h-5 w-5" /></span>
            </div>
        </div>
    </header>

    <div class="flex min-h-[calc(100vh-64px)]">
        <aside class="hidden w-64 shrink-0 flex-col bg-forest text-white md:flex">
            <div class="pt-4"><x-tenant-nav /></div>
            <div class="mt-auto p-4">
                <form method="POST" action="{{ route('logout') }}">@csrf<button class="nav-item nav-item-idle w-full"><x-icon name="logout" class="h-5 w-5" /> Log Out</button></form>
                <div class="mt-4 rounded-xl border border-white/15 p-4 text-sm">
                    <p class="flex items-center gap-2 font-semibold"><x-icon name="headset" class="h-5 w-5 text-gold" /> Need Help?</p>
                    <p class="mt-1 text-white/70">We're here for you.</p>
                    <a href="{{ route('contact') }}" class="mt-3 inline-flex w-full items-center justify-center rounded-lg border border-white px-3 py-2 text-xs font-semibold text-white">Contact Angie Ojeda</a>
                </div>
            </div>
        </aside>
        <div class="flex min-w-0 flex-1 flex-col">
            <div class="flex-1 p-4 sm:p-6 lg:p-8">{{ $slot }}</div>
            <x-brand-footer />
        </div>
    </div>

    <div x-cloak x-show="open" class="fixed inset-0 z-40 bg-black/40 md:hidden" @click="open = false"></div>
    <aside x-cloak x-show="open" x-transition class="fixed inset-y-0 left-0 z-50 flex w-[min(18rem,90vw)] flex-col bg-forest text-white md:hidden">
        <div class="flex items-center justify-between px-4 py-4">
            <span class="text-sm font-semibold">Menu</span>
            <button type="button" @click="open = false" class="text-sm">Close</button>
        </div>
        <x-tenant-nav />
        <form method="POST" action="{{ route('logout') }}" class="p-3">@csrf<button class="nav-item nav-item-idle w-full">Log Out</button></form>
    </aside>
</body>
</html>
