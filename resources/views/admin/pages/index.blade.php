<x-layouts.admin title="Pages">
    @if (session('status'))<p class="mb-4 text-green-700">{{ session('status') }}</p>@endif
    <div class="flex items-center justify-between">
        <h1 class="font-serif text-3xl">Pages</h1>
        <a href="{{ route('admin.pages.create') }}" class="btn-primary">Add page</a>
    </div>
    <div class="mt-6 overflow-hidden rounded-xl bg-white shadow-sm">
        <table class="w-full text-left text-sm">
            <thead class="bg-cream text-forest/70">
                <tr>
                    <th class="px-4 py-3">Title</th>
                    <th class="px-4 py-3">Slug</th>
                    <th class="px-4 py-3">Published</th>
                    <th class="px-4 py-3"></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pages as $page)
                    <tr class="border-t">
                        <td class="px-4 py-3 font-semibold">{{ $page->title }}</td>
                        <td class="px-4 py-3">/{{ $page->slug === 'privacy' || $page->slug === 'terms' ? $page->slug : 'p/'.$page->slug }}</td>
                        <td class="px-4 py-3">{{ $page->is_published ? 'Yes' : 'No' }}</td>
                        <td class="px-4 py-3 text-right">
                            <a class="font-semibold text-forest underline" href="{{ route('admin.pages.edit', $page) }}">Edit</a>
                            @unless ($page->isProtected())
                                <form method="POST" action="{{ route('admin.pages.destroy', $page) }}" class="inline" onsubmit="return confirm('Delete this page?')">
                                    @csrf
                                    @method('delete')
                                    <button class="ml-3 text-red-700">Delete</button>
                                </form>
                            @endunless
                        </td>
                    </tr>
                @empty
                    <tr><td class="px-4 py-6" colspan="4">No pages yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-layouts.admin>
