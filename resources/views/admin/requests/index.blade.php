<x-layouts.admin title="Requests">
    <h1 class="font-serif text-3xl">Request inbox</h1>
    <form class="mt-4 flex gap-3" method="GET">
        <select name="status" class="rounded-lg border-gray-300 text-sm" onchange="this.form.submit()">
            <option value="">All statuses</option>
            @foreach (['new','in_review','closed'] as $status)
                <option value="{{ $status }}" @selected(request('status')===$status)>{{ $status }}</option>
            @endforeach
        </select>
        <select name="type" class="rounded-lg border-gray-300 text-sm" onchange="this.form.submit()">
            <option value="">All types</option>
            @foreach ($types as $value => $label)
                <option value="{{ $value }}" @selected(request('type')===$value)>{{ $label }}</option>
            @endforeach
        </select>
    </form>
    <div class="mt-4 overflow-hidden rounded-xl bg-white shadow-sm">
        <table class="w-full text-left text-sm">
            <thead class="bg-cream"><tr><th class="p-3">When</th><th>From</th><th>Subject</th><th>Status</th></tr></thead>
            <tbody>
            @foreach ($requests as $item)
                <tr class="border-t">
                    <td class="p-3">{{ $item->created_at->format('M j, Y') }}</td>
                    <td>{{ $item->name }}</td>
                    <td><a href="{{ route('admin.requests.show', $item) }}">{{ $item->subject }}</a></td>
                    <td>{{ $item->status }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="p-3">{{ $requests->links() }}</div>
    </div>
</x-layouts.admin>
