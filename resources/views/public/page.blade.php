<x-layouts.public :title="$title" :meta-description="$metaDescription ?? null" :og-image="$ogImage ?? null">
    <div class="mx-auto max-w-3xl px-4 py-16">
        <h1 class="font-serif text-4xl text-forest">{{ $page->title }}</h1>
        <div class="mt-2 h-1 w-16 bg-gold"></div>
        <div class="prose-portal mt-8 text-forest/80">
            {!! $page->body !!}
        </div>
    </div>
</x-layouts.public>
