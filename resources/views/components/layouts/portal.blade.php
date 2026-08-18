@props(['title' => 'Tenant Portal'])
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700|playfair-display:600,700" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gray-100 font-sans text-forest">
<div class="flex min-h-screen">
    <aside class="hidden w-64 flex-col bg-forest text-white md:flex">
        <div class="flex items-center gap-3 px-5 py-6">
            <x-application-logo class="h-10 w-10" />
            <span class="text-sm font-semibold leading-tight">L&L International Ventures</span>
        </div>
        <nav class="flex-1 space-y-1 px-3">
            <a href="{{ route('tenant.dashboard') }}" class="block rounded-lg px-3 py-2 {{ request()->routeIs('tenant.dashboard') ? 'bg-gold text-forest' : 'hover:bg-forest-light' }}">Dashboard</a>
            <a href="{{ route('tenant.payments') }}" class="block rounded-lg px-3 py-2 {{ request()->routeIs('tenant.payments') ? 'bg-gold text-forest' : 'hover:bg-forest-light' }}">Rent & Payments</a>
            <a href="{{ route('tenant.requests.index') }}" class="block rounded-lg px-3 py-2 {{ request()->routeIs('tenant.requests.*') ? 'bg-gold text-forest' : 'hover:bg-forest-light' }}">My Requests</a>
            <a href="{{ route('contact') }}" class="block rounded-lg px-3 py-2 hover:bg-forest-light">Submit Request</a>
            <a href="{{ route('tenant.profile.edit') }}" class="block rounded-lg px-3 py-2 {{ request()->routeIs('tenant.profile.*') ? 'bg-gold text-forest' : 'hover:bg-forest-light' }}">My Profile</a>
        </nav>
        <form method="POST" action="{{ route('logout') }}" class="px-5 py-4">
            @csrf
            <button class="text-sm text-white/80">Log out</button>
        </form>
    </aside>
    <div class="flex-1">
        <header class="flex items-center justify-end gap-4 bg-white px-6 py-4 shadow-sm">
            <p class="text-sm">Welcome back, {{ auth()->user()->name }}</p>
        </header>
        <div class="p-6">{{ $slot }}</div>
    </div>
</div>
</body>
</html>
