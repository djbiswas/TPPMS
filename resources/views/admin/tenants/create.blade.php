<x-layouts.admin title="Invite tenant">
    <h1 class="font-serif text-3xl">Invite tenant</h1>
    <form method="POST" action="{{ route('admin.tenants.store') }}" class="mt-6 max-w-lg space-y-4 rounded-xl bg-white p-6 shadow-sm">
        @csrf
        <input name="name" placeholder="Full name" class="w-full rounded-lg border-gray-300" required>
        <input type="email" name="email" placeholder="Email" class="w-full rounded-lg border-gray-300" required>
        <input name="phone" placeholder="Phone" class="w-full rounded-lg border-gray-300">
        <p class="text-sm text-forest/70">They will receive an activation link. Assigned property: {{ $property?->fullAddress() }}</p>
        <button class="rounded-lg bg-forest px-4 py-2 text-white">Send invite</button>
    </form>
</x-layouts.admin>
