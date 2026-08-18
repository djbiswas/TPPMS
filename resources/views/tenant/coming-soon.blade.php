<x-layouts.portal :title="$title">
    <h1 class="font-serif text-4xl">{{ $title }}</h1>
    <p class="mt-3 max-w-xl text-forest/70">{{ $copy }}</p>
    <a href="{{ route('contact') }}" class="btn-primary mt-6">Contact property management</a>
</x-layouts.portal>
