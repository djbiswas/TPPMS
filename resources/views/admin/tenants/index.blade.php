<x-layouts.admin title="Tenants">
    @if (session('status'))<p class="mb-4 text-green-700">{{ session('status') }}</p>@endif
    <div class="flex items-center justify-between">
        <h1 class="font-serif text-3xl">Tenants</h1>
        <a href="{{ route('admin.tenants.create') }}" class="rounded-lg bg-forest px-4 py-2 text-white">Invite tenant</a>
    </div>
    <table class="mt-6 w-full rounded-xl bg-white text-left text-sm shadow-sm">
        <thead class="bg-cream"><tr><th class="p-3">Name</th><th>Email</th><th>Status</th><th></th></tr></thead>
        <tbody>
        @foreach ($tenants as $tenant)
            <tr class="border-t">
                <td class="p-3">{{ $tenant->name }}</td>
                <td>{{ $tenant->email }}</td>
                <td>{{ $tenant->status }}</td>
                <td>
                    <form method="POST" action="{{ route('admin.tenants.update', $tenant) }}">
                        @csrf
                        @method('patch')
                        <select name="status" class="rounded border-gray-300 text-sm" onchange="this.form.submit()">
                            @foreach (['pending_activation','active','suspended'] as $status)
                                <option value="{{ $status }}" @selected($tenant->status===$status)>{{ $status }}</option>
                            @endforeach
                        </select>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="mt-3">{{ $tenants->links() }}</div>
</x-layouts.admin>
