<x-layouts.admin title="Settings">
    @if (session('status'))<p class="mb-4 text-green-700">{{ session('status') }}</p>@endif
    <h1 class="font-serif text-3xl">Settings</h1>
    <form method="POST" action="{{ route('admin.settings.update') }}" class="mt-6 max-w-xl space-y-4 rounded-xl bg-white p-6 shadow-sm">
        @csrf
        @method('patch')
        <div><label class="text-sm font-semibold">Zelle handle</label><input name="zelle_handle" value="{{ $zelle }}" class="mt-1 w-full rounded-lg border-gray-300"></div>
        <div><label class="text-sm font-semibold">Wire instructions (private / logged-in)</label><textarea name="wire_instructions" rows="5" class="mt-1 w-full rounded-lg border-gray-300">{{ $wire }}</textarea></div>
        <div><label class="text-sm font-semibold">Office hours</label><input name="office_hours" value="{{ $hours }}" class="mt-1 w-full rounded-lg border-gray-300"></div>
        <div><label class="text-sm font-semibold">Manager email</label><input type="email" name="manager_email" value="{{ $property?->manager_email }}" class="mt-1 w-full rounded-lg border-gray-300"></div>
        <div><label class="text-sm font-semibold">Manager phone</label><input name="manager_phone" value="{{ $property?->manager_phone }}" class="mt-1 w-full rounded-lg border-gray-300"></div>
        <div><label class="text-sm font-semibold">Rent amount</label><input name="rent_amount" value="{{ $rentAmount }}" class="mt-1 w-full rounded-lg border-gray-300"></div>
        <div><label class="text-sm font-semibold">Next due date (display)</label><input name="next_due_date" value="{{ $dueDate }}" class="mt-1 w-full rounded-lg border-gray-300"></div>
        <button class="rounded-lg bg-forest px-4 py-2 text-white">Save</button>
    </form>
</x-layouts.admin>
