<x-layouts.public title="Contact Us — L&L Tenant Portal">
    <div class="bg-canvas">
    <div class="mx-auto max-w-6xl px-4 py-12">
        <div class="grid gap-8 lg:grid-cols-3">
            <div class="lg:col-span-2">
            <div class="card p-6 sm:p-8">
                <h1 class="font-serif text-4xl text-forest">Contact Us</h1>
                <div class="mt-2 h-1 w-16 bg-gold"></div>
                <p class="mt-4 text-forest/80">We're here to help! Please fill out the form below and we will get back to you as soon as possible.</p>

                <form method="POST" action="{{ route('contact.store') }}" enctype="multipart/form-data" class="mt-8 space-y-5">
                    @csrf
                    <div>
                        <label class="label-caps">Request type *</label>
                        <select name="type" class="form-control border-gold" required>
                            @foreach ($types as $value => $label)
                                <option value="{{ $value }}" @selected(old('type', 'maintenance') === $value)>{{ $label }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('type')" class="mt-1" />
                    </div>
                    <div>
                        <label class="label-caps">Subject *</label>
                        <input name="subject" value="{{ old('subject') }}" class="form-control" placeholder="Enter a short subject" required>
                        <x-input-error :messages="$errors->get('subject')" class="mt-1" />
                    </div>
                    <div>
                        <label class="label-caps">Description *</label>
                        <textarea name="body" rows="5" class="form-control" placeholder="Please provide details about your request..." required>{{ old('body') }}</textarea>
                        <x-input-error :messages="$errors->get('body')" class="mt-1" />
                    </div>
                    <div>
                        <label class="label-caps">Preferred contact method</label>
                        <select name="preferred_contact" class="form-control">
                            <option value="email" @selected(old('preferred_contact', 'email') === 'email')>Email</option>
                            <option value="phone" @selected(old('preferred_contact') === 'phone')>Phone</option>
                        </select>
                    </div>
                    <div class="grid gap-4 md:grid-cols-2">
                        <div>
                            <label class="label-caps">Your email *</label>
                            <input type="email" name="email" value="{{ old('email', $user?->email) }}" class="form-control" placeholder="name@email.com" required>
                        </div>
                        <div>
                            <label class="label-caps">Phone number</label>
                            <input name="phone" value="{{ old('phone', $user?->phone) }}" class="form-control" placeholder="(512) 123-4567">
                        </div>
                    </div>

                    <details class="rounded-xl border border-cream bg-canvas p-4">
                        <summary class="cursor-pointer text-sm font-semibold text-forest">Additional details</summary>
                        <div class="mt-4 space-y-4">
                            <div>
                                <label class="label-caps">Your name *</label>
                                <input name="name" value="{{ old('name', $user?->name ?: 'Portal visitor') }}" class="form-control" required>
                            </div>
                            <div>
                                <label class="label-caps">Property / unit</label>
                                <input name="unit" value="{{ old('unit', $property?->fullAddress()) }}" class="form-control">
                            </div>
                            <div class="grid gap-4 md:grid-cols-2">
                                <div>
                                    <label class="label-caps">Priority</label>
                                    <select name="priority" class="form-control">
                                        <option value="normal">Normal</option>
                                        <option value="high">High</option>
                                        <option value="urgent">Urgent</option>
                                    </select>
                                </div>
                                <label class="mt-7 flex items-center gap-2 text-sm">
                                    <input type="checkbox" name="permission_to_enter" value="1" class="rounded border-gray-300 text-forest"> Permission to enter
                                </label>
                            </div>
                            <div>
                                <label class="label-caps">Photo or document</label>
                                <input type="file" name="attachment" class="mt-1 block w-full text-sm">
                            </div>
                        </div>
                    </details>

                    <button class="btn-primary w-full"><x-icon name="envelope" class="h-4 w-4" /> Submit request</button>
                </form>
            </div>
            @if (session('status'))
                <div class="mt-6 flex items-start gap-3 rounded-2xl bg-cream p-4 text-sm text-forest">
                    <x-icon name="check" class="mt-0.5 h-6 w-6 shrink-0 text-green-700" />
                    <p>{{ session('status') }}</p>
                </div>
            @endif
            </div>

            <div class="space-y-6">
                <x-property-card :property="$property" />
                <x-pay-rent-card variant="contact" :zelle-handle="$zelleHandle" />
                <x-manager-card :property="$property" />
            </div>
        </div>
    </div>
    </div>
</x-layouts.public>
