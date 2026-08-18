<x-layouts.portal title="Request">
    <a href="{{ route('tenant.requests.index') }}" class="text-sm text-gold">Back</a>
    <h1 class="mt-2 font-serif text-3xl">{{ $tenantRequest->subject }}</h1>
    <p class="mt-1 text-sm uppercase">{{ $tenantRequest->status }} · {{ $tenantRequest->typeLabel() }}</p>
    <p class="mt-6 whitespace-pre-line rounded-2xl bg-white p-6 shadow-sm">{{ $tenantRequest->body }}</p>
    @foreach ($tenantRequest->attachments as $file)
        <a class="mt-3 inline-block text-sm underline" href="{{ route('attachments.download', $file) }}">{{ $file->original_name }}</a>
    @endforeach
</x-layouts.portal>
