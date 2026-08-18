@props(['property' => null])

<div class="card overflow-hidden">
    <img src="{{ asset($property?->image_path ?: 'images/property-hero.jpg') }}" alt="{{ $property?->fullAddress() ?? 'Property' }}" class="h-44 w-full object-cover">
    <div class="p-4">
        <p class="font-semibold">{{ $property?->fullAddress() ?? '317 Freedom Park, Liberty Hill, TX 78642' }}</p>
        <p class="mt-1 flex items-center gap-2 text-sm text-forest/70">
            <x-icon name="lock" class="h-4 w-4 text-gold" />
            {{ $property?->type ?? 'Single Family Home' }}
        </p>
    </div>
</div>
