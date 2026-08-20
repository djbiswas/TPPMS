@php
    $settingsOpen = request()->routeIs('admin.settings.*', 'admin.pages.*', 'license.*');
    $sub = 'block rounded-lg px-3 py-1.5 text-[13px] text-white/80 hover:bg-white/10 hover:text-white';
    $subActive = 'block rounded-lg px-3 py-1.5 text-[13px] bg-gold text-forest font-semibold';
@endphp
<nav class="flex-1 space-y-1 px-3 text-sm">
    <a class="nav-item {{ request()->routeIs('admin.dashboard') ? 'nav-item-active' : 'nav-item-idle' }}" href="{{ route('admin.dashboard') }}"><x-icon name="dashboard" class="h-5 w-5" /> Dashboard</a>
    <a class="nav-item {{ request()->routeIs('admin.requests.*') ? 'nav-item-active' : 'nav-item-idle' }}" href="{{ route('admin.requests.index') }}"><x-icon name="wrench" class="h-5 w-5" /> Requests</a>
    <a class="nav-item {{ request()->routeIs('admin.tenants.*') ? 'nav-item-active' : 'nav-item-idle' }}" href="{{ route('admin.tenants.index') }}"><x-icon name="user" class="h-5 w-5" /> Tenants</a>

    <div x-data="{ open: {{ $settingsOpen ? 'true' : 'false' }} }">
        <button type="button" class="nav-item {{ $settingsOpen ? 'nav-item-active' : 'nav-item-idle' }} w-full" @click="open = !open">
            <x-icon name="document" class="h-5 w-5" />
            <span class="flex-1 text-left">Settings</span>
            <x-icon name="chevron" class="h-4 w-4 transition-transform" x-bind:class="open ? 'rotate-180' : ''" />
        </button>
        <div x-show="open" x-cloak class="mb-1 ml-4 mt-1 space-y-0.5 border-l border-white/15 pl-3">
            <p class="px-3 pb-1 pt-2 text-[10px] font-semibold uppercase tracking-[0.16em] text-gold">Options</p>
            <a class="{{ request()->routeIs('admin.settings.*') && request('tab', 'branding') === 'branding' ? $subActive : $sub }}" href="{{ route('admin.settings.edit', ['tab' => 'branding']) }}">Branding &amp; SEO</a>
            <a class="{{ request()->routeIs('admin.settings.*') && request('tab') === 'property' ? $subActive : $sub }}" href="{{ route('admin.settings.edit', ['tab' => 'property']) }}">Property &amp; payments</a>
            <a class="{{ request()->routeIs('license.*') ? $subActive : $sub }}" href="{{ route('license.edit') }}">License</a>

            <p class="px-3 pb-1 pt-3 text-[10px] font-semibold uppercase tracking-[0.16em] text-gold">Pages</p>
            <a class="{{ request()->routeIs('admin.pages.index') ? $subActive : $sub }}" href="{{ route('admin.pages.index') }}">All pages</a>
            @foreach ($navPages ?? [] as $navPage)
                <a class="{{ request()->routeIs('admin.pages.edit') && (int) optional(request()->route('page'))->id === (int) $navPage->id ? $subActive : $sub }}" href="{{ route('admin.pages.edit', $navPage) }}">{{ $navPage->title }}</a>
            @endforeach
            <a class="{{ request()->routeIs('admin.pages.create') ? $subActive : $sub }}" href="{{ route('admin.pages.create') }}">+ Add page</a>
        </div>
    </div>
</nav>
