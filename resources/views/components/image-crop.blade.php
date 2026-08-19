@props([
    'name',
    'label' => 'Image',
    'aspect' => null,
    'current' => null,
    'hint' => null,
])
@php
    $preview = $current ? \App\Support\Company::mediaUrl($current) : null;
@endphp
<div
    class="space-y-2"
    x-data="imageCrop({ aspect: {{ $aspect === null ? 'null' : $aspect }}, preview: @js($preview) })"
>
    <label class="text-sm font-semibold">{{ $label }}</label>
    @if ($hint)
        <p class="text-xs text-forest/60">{{ $hint }}</p>
    @endif
    <template x-if="preview">
        <img :src="preview" alt="" class="max-h-28 rounded-lg border border-cream object-contain bg-white">
    </template>
    <input type="file" accept="image/*" class="block w-full text-sm" @change="pick($event)">
    <input type="hidden" name="{{ $name }}_data" x-ref="data">
    <label class="flex items-center gap-2 text-sm text-forest/70">
        <input type="checkbox" name="{{ $name }}_remove" value="1" class="rounded border-gray-300 text-forest">
        Remove current image
    </label>

    <div x-cloak x-show="open" class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 p-4" @keydown.escape.window="open = false">
        <div class="w-full max-w-3xl rounded-xl bg-white p-4 shadow-xl">
            <p class="mb-3 font-semibold">Crop image</p>
            <div class="max-h-[70vh] overflow-hidden bg-canvas">
                <img x-ref="cropImg" alt="Crop" class="max-w-full">
            </div>
            <div class="mt-4 flex justify-end gap-2">
                <button type="button" class="btn-outline" @click="open = false">Cancel</button>
                <button type="button" class="btn-primary" @click="apply()">Use crop</button>
            </div>
        </div>
    </div>
</div>
