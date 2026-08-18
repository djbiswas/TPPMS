@props(['title' => 'Admin'])
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
    <aside class="hidden w-64 flex-col bg-forest-dark text-white md:flex">
        <div class="px-5 py-6 font-semibold">L&L Admin</div>
        <nav class="flex-1 space-y-1 px-3 text-sm">
            <a class="block rounded-lg px-3 py-2 hover:bg-forest" href="{{ route('admin.dashboard') }}">Dashboard</a>
            <a class="block rounded-lg px-3 py-2 hover:bg-forest" href="{{ route('admin.requests.index') }}">Requests</a>
            <a class="block rounded-lg px-3 py-2 hover:bg-forest" href="{{ route('admin.tenants.index') }}">Tenants</a>
            <a class="block rounded-lg px-3 py-2 hover:bg-forest" href="{{ route('admin.settings.edit') }}">Settings</a>
            <a class="block rounded-lg px-3 py-2 hover:bg-forest" href="{{ route('license.edit') }}">License</a>
        </nav>
        <form method="POST" action="{{ route('logout') }}" class="px-5 py-4">@csrf<button class="text-sm">Log out</button></form>
    </aside>
    <div class="flex-1 p-6">{{ $slot }}</div>
</div>
</body>
</html>
