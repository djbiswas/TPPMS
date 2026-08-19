<x-layouts.admin :title="$page->exists ? 'Edit page' : 'Add page'">
    <h1 class="font-serif text-3xl">{{ $page->exists ? 'Edit page' : 'Add page' }}</h1>
    <form method="POST" action="{{ $page->exists ? route('admin.pages.update', $page) : route('admin.pages.store') }}" enctype="multipart/form-data" class="mt-6 max-w-3xl space-y-4 rounded-xl bg-white p-6 shadow-sm">
        @csrf
        @if ($page->exists)
            @method('patch')
        @endif
        <div>
            <label class="text-sm font-semibold">Title</label>
            <input name="title" value="{{ old('title', $page->title) }}" class="form-control" required>
            <x-input-error :messages="$errors->get('title')" class="mt-1" />
        </div>
        <div>
            <label class="text-sm font-semibold">Slug</label>
            <input name="slug" value="{{ old('slug', $page->slug) }}" class="form-control" @disabled($page->isProtected())>
            @if ($page->isProtected())
                <input type="hidden" name="slug" value="{{ $page->slug }}">
                <p class="mt-1 text-xs text-forest/60">Privacy and Terms slugs cannot change.</p>
            @endif
        </div>
        <div>
            <label class="text-sm font-semibold">Body (HTML allowed)</label>
            <textarea name="body" rows="12" class="form-control font-mono text-sm">{{ old('body', $page->body) }}</textarea>
        </div>
        <div>
            <label class="text-sm font-semibold">Meta title</label>
            <input name="meta_title" value="{{ old('meta_title', $page->meta_title) }}" class="form-control">
        </div>
        <div>
            <label class="text-sm font-semibold">Meta description</label>
            <textarea name="meta_description" rows="3" class="form-control">{{ old('meta_description', $page->meta_description) }}</textarea>
        </div>
        <x-image-crop name="og_image" label="Social / OG image" :aspect="1.91" :current="$page->og_image" hint="Cropped to 1200×630." />
        <label class="flex items-center gap-2 text-sm">
            <input type="checkbox" name="is_published" value="1" class="rounded border-gray-300 text-forest" @checked(old('is_published', $page->is_published ?? true))>
            Published
        </label>
        <button class="btn-primary">Save page</button>
        <a href="{{ route('admin.pages.index') }}" class="ml-3 text-sm underline">Back</a>
    </form>
</x-layouts.admin>
