<x-layouts.admin title="Site settings">
    @if (session('status'))<p class="mb-4 text-green-700">{{ session('status') }}</p>@endif
    <h1 class="font-serif text-3xl">Site settings</h1>
    <div class="mt-4 flex flex-wrap gap-2 text-sm">
        <a class="rounded-full px-4 py-1.5 {{ ($tab ?? 'branding') === 'branding' ? 'bg-forest text-white' : 'bg-white' }}" href="{{ route('admin.settings.edit', ['tab' => 'branding']) }}">Branding &amp; SEO</a>
        <a class="rounded-full px-4 py-1.5 {{ ($tab ?? '') === 'property' ? 'bg-forest text-white' : 'bg-white' }}" href="{{ route('admin.settings.edit', ['tab' => 'property']) }}">Property &amp; payments</a>
    </div>

    <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data" class="mt-6 max-w-3xl space-y-5 rounded-xl bg-white p-6 shadow-sm">
        @csrf
        @method('patch')
        <input type="hidden" name="tab" value="{{ $tab }}">

        <div class="{{ ($tab ?? 'branding') === 'branding' ? '' : 'hidden' }} space-y-5">
            <div>
                <label class="text-sm font-semibold">Company name</label>
                <input name="company_name" value="{{ old('company_name', $site['company_name']) }}" class="form-control" required>
            </div>
            <div>
                <label class="text-sm font-semibold">Tagline</label>
                <input name="tagline" value="{{ old('tagline', $site['tagline']) }}" class="form-control">
            </div>
            <div>
                <label class="text-sm font-semibold">Default meta title</label>
                <input name="meta_title" value="{{ old('meta_title', $site['meta_title']) }}" class="form-control">
            </div>
            <div>
                <label class="text-sm font-semibold">Default meta description</label>
                <textarea name="meta_description" rows="3" class="form-control">{{ old('meta_description', $site['meta_description']) }}</textarea>
            </div>
            <div>
                <label class="text-sm font-semibold">Meta keywords</label>
                <input name="meta_keywords" value="{{ old('meta_keywords', $site['meta_keywords']) }}" class="form-control">
            </div>
            <x-image-crop name="logo" label="Header logo" :current="$site['logo']" hint="Wide crop. Max 800px wide." />
            <x-image-crop name="favicon" label="Favicon / icon" :aspect="1" :current="$site['favicon']" hint="Square crop, saved at 512px." />
            <x-image-crop name="og_image" label="Default social image" :aspect="1.91" :current="$site['og_image']" hint="1200×630 Open Graph image." />
            <x-image-crop name="property_hero" label="Property / hero photo" :aspect="1.78" :current="$site['property_hero']" hint="16:9 crop, up to 1920px wide." />
        </div>

        <div class="{{ ($tab ?? '') === 'property' ? '' : 'hidden' }} space-y-4">
            <div><label class="text-sm font-semibold">Zelle handle</label><input name="zelle_handle" value="{{ old('zelle_handle', $zelle) }}" class="form-control" required></div>
            <div><label class="text-sm font-semibold">Wire instructions</label><textarea name="wire_instructions" rows="5" class="form-control">{{ old('wire_instructions', $wire) }}</textarea></div>
            <div><label class="text-sm font-semibold">Office hours</label><input name="office_hours" value="{{ old('office_hours', $hours) }}" class="form-control"></div>
            <div><label class="text-sm font-semibold">Manager email</label><input type="email" name="manager_email" value="{{ old('manager_email', $property?->manager_email) }}" class="form-control" required></div>
            <div><label class="text-sm font-semibold">Manager phone</label><input name="manager_phone" value="{{ old('manager_phone', $property?->manager_phone) }}" class="form-control" required></div>
            <div><label class="text-sm font-semibold">Rent amount</label><input name="rent_amount" value="{{ old('rent_amount', $rentAmount) }}" class="form-control" required></div>
            <div><label class="text-sm font-semibold">Next due date (display)</label><input name="next_due_date" value="{{ old('next_due_date', $dueDate) }}" class="form-control" required></div>
        </div>

        @if (($tab ?? 'branding') === 'branding')
            <input type="hidden" name="zelle_handle" value="{{ $zelle }}">
            <input type="hidden" name="wire_instructions" value="{{ $wire }}">
            <input type="hidden" name="office_hours" value="{{ $hours }}">
            <input type="hidden" name="manager_email" value="{{ $property?->manager_email }}">
            <input type="hidden" name="manager_phone" value="{{ $property?->manager_phone }}">
            <input type="hidden" name="rent_amount" value="{{ $rentAmount }}">
            <input type="hidden" name="next_due_date" value="{{ $dueDate }}">
        @else
            <input type="hidden" name="company_name" value="{{ $site['company_name'] }}">
            <input type="hidden" name="tagline" value="{{ $site['tagline'] }}">
            <input type="hidden" name="meta_title" value="{{ $site['meta_title'] }}">
            <input type="hidden" name="meta_description" value="{{ $site['meta_description'] }}">
            <input type="hidden" name="meta_keywords" value="{{ $site['meta_keywords'] }}">
        @endif

        <button class="btn-primary">Save</button>
    </form>
</x-layouts.admin>
