@props(['variant' => 'mark'])
@php
    $uploaded = $siteLogo ?? null;
    $ink = $variant === 'mark-light' ? '#F5F1E8' : '#2B2B2B';
    $gold = '#B89356';
@endphp
@if ($uploaded)
    <img src="{{ $uploaded }}" alt="{{ $siteName ?? 'Logo' }}" {{ $attributes->merge(['class' => 'object-contain']) }}>
@elseif ($variant === 'full')
    <img src="{{ asset('images/branding/ll-logo-official.png') }}" alt="L&amp;L International Ventures LLC" {{ $attributes->merge(['class' => 'object-contain']) }}>
@else
<svg viewBox="0 0 200 118" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" {{ $attributes }}>
    <polyline points="62,28 100,8 138,28" stroke="{{ $ink }}" stroke-width="3.2" stroke-linecap="round" stroke-linejoin="round"/>
    <g transform="translate(88,30)" stroke="{{ $gold }}" stroke-width="1.6">
        <rect x="0" y="0" width="24" height="24"/>
        <line x1="12" y1="0" x2="12" y2="24"/>
        <line x1="0" y1="12" x2="24" y2="12"/>
    </g>
    <text x="28" y="104" fill="{{ $ink }}" font-family="Playfair Display, Georgia, serif" font-size="64" font-weight="700">L</text>
    <text x="118" y="104" fill="{{ $ink }}" font-family="Playfair Display, Georgia, serif" font-size="64" font-weight="700">L</text>
    <text x="78" y="92" fill="{{ $gold }}" font-family="Playfair Display, Georgia, serif" font-size="42" font-style="italic" font-weight="700">&amp;</text>
</svg>
@endif
