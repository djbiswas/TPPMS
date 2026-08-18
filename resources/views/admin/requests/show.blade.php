<x-layouts.admin title="Request">
    @if (session('status'))<p class="mb-4 text-green-700">{{ session('status') }}</p>@endif
    <h1 class="font-serif text-3xl">{{ $tenantRequest->subject }}</h1>
    <p class="text-sm">{{ $tenantRequest->typeLabel() }} · {{ $tenantRequest->email }} · {{ $tenantRequest->phone }}</p>
    <p class="mt-6 whitespace-pre-line rounded-xl bg-white p-6 shadow-sm">{{ $tenantRequest->body }}</p>
    @foreach ($tenantRequest->attachments as $file)
        <a class="mt-2 inline-block underline" href="{{ route('attachments.download', $file) }}">{{ $file->original_name }}</a>
    @endforeach
    <form method="POST" action="{{ route('admin.requests.update', $tenantRequest) }}" class="mt-6 max-w-lg space-y-3 rounded-xl bg-white p-6 shadow-sm">
        @csrf
        @method('patch')
        <select name="status" class="w-full rounded-lg border-gray-300">
            @foreach (['new','in_review','closed'] as $status)
                <option value="{{ $status }}" @selected($tenantRequest->status===$status)>{{ $status }}</option>
            @endforeach
        </select>
        <textarea name="internal_note" rows="4" class="w-full rounded-lg border-gray-300" placeholder="Internal note">{{ $tenantRequest->internal_note }}</textarea>
        <button class="rounded-lg bg-forest px-4 py-2 text-white">Update</button>
    </form>
</x-layouts.admin>
