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
</head>
<body class="min-h-screen bg-[#f4f1ea] font-sans text-forest" x-data="{ open: false }">
<div class="flex min-h-screen">
    <aside class="hidden w-64 flex-col bg-forest-dark text-white md:flex">
        <div class="flex items-center gap-3 px-5 py-6">
            <x-application-logo class="h-10 w-10" />
            <span class="text-sm font-semibold">L&amp;L Admin</span>
        </div>
        <nav class="flex-1 space-y-1 px-3 text-sm">
            <a class="nav-item {{ request()->routeIs('admin.dashboard') ? 'nav-item-active' : 'nav-item-idle' }}" href="{{ route('admin.dashboard') }}"><x-icon name="dashboard" class="h-5 w-5" /> Dashboard</a>
            <a class="nav-item {{ request()->routeIs('admin.requests.*') ? 'nav-item-active' : 'nav-item-idle' }}" href="{{ route('admin.requests.index') }}"><x-icon name="wrench" class="h-5 w-5" /> Requests</a>
            <a class="nav-item {{ request()->routeIs('admin.tenants.*') ? 'nav-item-active' : 'nav-item-idle' }}" href="{{ route('admin.tenants.index') }}"><x-icon name="user" class="h-5 w-5" /> Tenants</a>
            <a class="nav-item {{ request()->routeIs('admin.settings.*') ? 'nav-item-active' : 'nav-item-idle' }}" href="{{ route('admin.settings.edit') }}"><x-icon name="document" class="h-5 w-5" /> Settings</a>
            <a class="nav-item {{ request()->routeIs('license.*') ? 'nav-item-active' : 'nav-item-idle' }}" href="{{ route('license.edit') }}"><x-icon name="lock" class="h-5 w-5" /> License</a>
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
    <a class="block py-2" href="{{ route('admin.dashboard') }}">Dashboard</a>
    <a class="block py-2" href="{{ route('admin.requests.index') }}">Requests</a>
    <a class="block py-2" href="{{ route('admin.tenants.index') }}">Tenants</a>
    <a class="block py-2" href="{{ route('admin.settings.edit') }}">Settings</a>
    <a class="block py-2" href="{{ route('license.edit') }}">License</a>
</aside>
</body>
</html>
