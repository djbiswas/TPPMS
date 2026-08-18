@props(['class' => 'flex-1 space-y-1 px-3'])

@php
    $items = [
        ['route' => 'tenant.dashboard', 'match' => 'tenant.dashboard', 'icon' => 'dashboard', 'label' => 'Dashboard'],
        ['route' => 'tenant.payments', 'match' => 'tenant.payments', 'icon' => 'card', 'label' => 'Rent & Payments'],
        ['route' => 'tenant.documents', 'match' => 'tenant.documents', 'icon' => 'document', 'label' => 'Lease Documents'],
        ['route' => 'tenant.history', 'match' => 'tenant.history', 'icon' => 'clock', 'label' => 'Payment History'],
        ['route' => 'tenant.requests.index', 'match' => 'tenant.requests.*', 'icon' => 'wrench', 'label' => 'Maintenance Requests'],
        ['route' => 'tenant.messages', 'match' => 'tenant.messages', 'icon' => 'envelope', 'label' => 'Messages'],
        ['route' => 'tenant.profile.edit', 'match' => 'tenant.profile.*', 'icon' => 'user', 'label' => 'My Profile'],
    ];
@endphp

<nav class="{{ $class }}">
    @foreach ($items as $item)
        <a href="{{ route($item['route']) }}" class="nav-item {{ request()->routeIs($item['match']) ? 'nav-item-active' : 'nav-item-idle' }}">
            <x-icon :name="$item['icon']" class="h-5 w-5 shrink-0" />
            <span>{{ $item['label'] }}</span>
        </a>
    @endforeach
</nav>
