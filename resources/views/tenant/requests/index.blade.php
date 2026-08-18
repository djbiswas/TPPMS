<x-layouts.portal title="My requests">
    <h1 class="font-serif text-3xl">My Requests</h1>
    <a href="{{ route('contact') }}" class="mt-4 inline-block text-sm font-semibold text-gold">Submit a new request</a>
    <div class="mt-6 overflow-hidden rounded-2xl bg-white shadow-sm">
        <table class="w-full text-left text-sm">
            <thead class="bg-cream"><tr><th class="p-3">Date</th><th>Subject</th><th>Type</th><th>Status</th></tr></thead>
            <tbody>
            @foreach ($requests as $item)
                <tr class="border-t">
                    <td class="p-3">{{ $item->created_at->format('M j, Y') }}</td>
                    <td><a class="font-medium" href="{{ route('tenant.requests.show', $item) }}">{{ $item->subject }}</a></td>
                    <td>{{ $item->typeLabel() }}</td>
                    <td>{{ $item->status }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="p-3">{{ $requests->links() }}</div>
    </div>
</x-layouts.portal>
