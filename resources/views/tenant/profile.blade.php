<x-layouts.portal title="Profile">
    <h1 class="font-serif text-3xl">My Profile</h1>
    <form method="POST" action="{{ route('tenant.profile.update') }}" class="mt-6 max-w-lg space-y-4 rounded-2xl bg-white p-6 shadow-sm">
        @csrf
        @method('patch')
        <div>
            <label class="text-sm font-semibold">Name</label>
            <input name="name" value="{{ old('name', $user->name) }}" class="mt-1 w-full rounded-lg border-gray-300" required>
        </div>
        <div>
            <label class="text-sm font-semibold">Email</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" class="mt-1 w-full rounded-lg border-gray-300" required>
        </div>
        <div>
            <label class="text-sm font-semibold">Phone</label>
            <input name="phone" value="{{ old('phone', $user->phone) }}" class="mt-1 w-full rounded-lg border-gray-300">
        </div>
        <button class="rounded-lg bg-forest px-4 py-2 text-white">Save</button>
    </form>
</x-layouts.portal>
