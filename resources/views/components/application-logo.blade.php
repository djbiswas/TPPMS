@props(['variant' => 'mark'])
@php
    $src = $siteLogo ?? asset('images/branding/ll-logo-official.jpg');
    $classes = $variant === 'mark-light'
        ? 'object-contain rounded-md bg-white p-1'
        : 'object-contain';
@endphp
<img src="{{ $src }}" alt="{{ $siteName ?? 'L&L International Ventures LLC' }}" {{ $attributes->merge(['class' => $classes]) }}>
