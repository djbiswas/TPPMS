@props(['title' => 'Admin'])
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title }} — L&amp;L Admin</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700|playfair-display:600,700" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('head')
</head>
<body class="min-h-screen bg-[#f4f1ea] font-sans text-forest" x-data="{ open: false }">
<div class="flex min-h-screen">
    <aside class="hidden w-64 flex-col bg-forest-dark text-white md:flex">
        <div class="flex items-center gap-3 px-5 py-6">
            <x-application-logo variant="mark-light" class="h-14 w-auto max-w-[9.5rem]" />
            <span class="text-sm font-semibold tracking-wide">Admin</span>
        </div>
        <nav class="flex-1 overflow-y-auto py-2">
            <x-admin-nav />
        </nav>
        <form method="POST" action="{{ route('logout') }}" class="px-5 py-6">@csrf<button class="nav-item nav-item-idle w-full"><x-icon name="logout" class="h-5 w-5" /> Log out</button></form>
    </aside>
    <div class="flex min-w-0 flex-1 flex-col">
        <header class="flex items-center justify-between bg-white px-4 py-4 shadow-sm md:justify-end">
            <button class="md:hidden" type="button" @click="open = true"><x-icon name="dashboard" class="h-6 w-6" /></button>
            <p class="text-sm">{{ auth()->user()->name }} · Administrator</p>
        </header>
        <div class="flex-1 p-4 md:p-8">{{ $slot }}</div>
    </div>
</div>
<div x-cloak x-show="open" class="fixed inset-0 z-40 bg-black/40 md:hidden" @click="open = false"></div>
<aside x-cloak x-show="open" class="fixed inset-y-0 left-0 z-50 w-64 bg-forest-dark p-4 text-white md:hidden">
    <button class="mb-4 text-sm" @click="open = false">Close</button>
    <x-admin-nav />
</aside>
</body>
</html>
