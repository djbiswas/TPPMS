@props(['property' => null, 'showHours' => true])

<div class="card p-5">
    <h2 class="label-caps">Property manager</h2>
    <div class="mt-3 flex items-center gap-3">
        <span class="flex h-10 w-10 items-center justify-center rounded-full bg-gold/20 text-gold">
            <x-icon name="user" class="h-5 w-5" />
        </span>
        <div>
            <p class="font-semibold">{{ $property?->manager_name ?? 'Angie Ojeda' }}</p>
            <p class="text-sm text-forest/70">{{ $property?->manager_title ?? 'Property Manager' }}</p>
        </div>
    </div>
    <p class="mt-3 flex items-center gap-2 break-all text-sm">
        <x-icon name="envelope" class="h-4 w-4 shrink-0 text-gold" />
        {{ $property?->manager_email ?? 'manager@llinternationalventures.com' }}
    </p>
    <p class="mt-1 flex items-center gap-2 text-sm">
        <x-icon name="phone" class="h-4 w-4 text-gold" />
        {{ $property?->manager_phone ?? '(512) 806-3630' }}
    </p>
    @if ($showHours)
        <p class="mt-3 text-sm text-forest/70">{{ $property?->office_hours ?? 'Mon - Fri | 9:00 AM – 5:00 PM' }}</p>
    @endif
</div>
