<x-layouts.public title="Contact Us — L&L Tenant Portal">
    <div class="mx-auto max-w-6xl px-4 py-12">
        <h1 class="font-serif text-4xl text-forest">Contact Us</h1>
        <div class="mt-2 h-1 w-16 bg-gold"></div>
        <p class="mt-4 max-w-2xl text-forest/80">We're here to help! Please fill out the form below and we will get back to you as soon as possible.</p>

        <div class="mt-10 grid gap-8 lg:grid-cols-3">
            <div class="lg:col-span-2 rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-100">
                @if (session('status'))
                    <div class="mb-6 flex gap-3 rounded-lg bg-green-50 p-4 text-sm text-green-800">
                        {{ session('status') }}
                    </div>
                @endif
                <form method="POST" action="{{ route('contact.store') }}" enctype="multipart/form-data" class="space-y-5" x-data="{ type: '{{ old('type', 'maintenance') }}' }">
                    @csrf
                    <div>
                        <label class="text-xs font-bold tracking-[0.16em]">Request type *</label>
                        <select name="type" x-model="type" class="mt-1 w-full rounded-lg border-gray-300" required>
                            @foreach ($types as $value => $label)
                                <option value="{{ $value }}">{{ $label }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('type')" class="mt-1" />
                    </div>
                    <div>
                        <label class="text-xs font-bold tracking-[0.16em]">Subject *</label>
                        <input name="subject" value="{{ old('subject') }}" class="mt-1 w-full rounded-lg border-gray-300" placeholder="Enter a short subject" required>
                        <x-input-error :messages="$errors->get('subject')" class="mt-1" />
                    </div>
                    <div>
                        <label class="text-xs font-bold tracking-[0.16em]">Description *</label>
                        <textarea name="body" rows="5" class="mt-1 w-full rounded-lg border-gray-300" placeholder="Please provide details about your request..." required>{{ old('body') }}</textarea>
                        <x-input-error :messages="$errors->get('body')" class="mt-1" />
                    </div>
                    <div class="grid gap-4 md:grid-cols-2">
                        <div>
                            <label class="text-xs font-bold tracking-[0.16em]">Your name *</label>
                            <input name="name" value="{{ old('name', $user?->name) }}" class="mt-1 w-full rounded-lg border-gray-300" required>
                        </div>
                        <div>
                            <label class="text-xs font-bold tracking-[0.16em]">Preferred contact</label>
                            <select name="preferred_contact" class="mt-1 w-full rounded-lg border-gray-300">
                                <option value="email">Email</option>
                                <option value="phone">Phone</option>
                            </select>
                        </div>
                    </div>
                    <div class="grid gap-4 md:grid-cols-2">
                        <div>
                            <label class="text-xs font-bold tracking-[0.16em]">Your email *</label>
                            <input type="email" name="email" value="{{ old('email', $user?->email) }}" class="mt-1 w-full rounded-lg border-gray-300" required>
                        </div>
                        <div>
                            <label class="text-xs font-bold tracking-[0.16em]">Phone number</label>
                            <input name="phone" value="{{ old('phone', $user?->phone) }}" class="mt-1 w-full rounded-lg border-gray-300" placeholder="(512) 123-4567">
                        </div>
                    </div>
                    <div>
                        <label class="text-xs font-bold tracking-[0.16em]">Property / unit</label>
                        <input name="unit" value="{{ old('unit', $property?->fullAddress()) }}" class="mt-1 w-full rounded-lg border-gray-300">
                    </div>
                    <div x-show="['maintenance','work_order','urgent'].includes(type)" class="grid gap-4 md:grid-cols-2">
                        <div>
                            <label class="text-xs font-bold tracking-[0.16em]">Priority</label>
                            <select name="priority" class="mt-1 w-full rounded-lg border-gray-300">
                                <option value="normal">Normal</option>
                                <option value="high">High</option>
                                <option value="urgent">Urgent</option>
                            </select>
                        </div>
                        <label class="mt-7 flex items-center gap-2 text-sm">
                            <input type="checkbox" name="permission_to_enter" value="1" class="rounded border-gray-300"> Permission to enter
                        </label>
                    </div>
                    <div>
                        <label class="text-xs font-bold tracking-[0.16em]">Photo or document</label>
                        <input type="file" name="attachment" class="mt-1 block w-full text-sm">
                    </div>
                    <button class="w-full rounded-lg bg-forest py-3 font-semibold tracking-wide text-white">Submit request</button>
                </form>
            </div>

            <div class="space-y-6">
                <div class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-gray-100">
                    <img src="{{ asset('images/property-hero.jpg') }}" alt="Property" class="h-40 w-full object-cover">
                    <div class="p-4">
                        <p class="font-semibold">{{ $property?->fullAddress() }}</p>
                        <p class="mt-1 text-sm text-forest/70">{{ $property?->type }}</p>
                    </div>
                </div>
                <div class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-gray-100">
                    <h2 class="text-sm font-bold tracking-[0.16em]">PAY YOUR RENT</h2>
                    <p class="mt-1 text-sm text-forest/70">Choose your preferred payment method.</p>
                    <p class="mt-4 font-semibold">Pay with Zelle</p>
                    <p class="text-lg font-semibold text-zelle">{{ $zelleHandle }}</p>
                    <p class="mt-2 text-sm text-forest/70">Scan code in your banking app or search our username.</p>
                    <p class="mt-4 text-xs text-forest/60">Card payments are planned for a later phase. All listed instructions are for this property only.</p>
                </div>
                <div class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-gray-100">
                    <h2 class="text-sm font-bold tracking-[0.16em]">PROPERTY MANAGER</h2>
                    <p class="mt-3 font-semibold">{{ $property?->manager_name }}</p>
                    <p class="text-sm">{{ $property?->manager_title }}</p>
                    <p class="mt-2 text-sm">{{ $property?->manager_email }}</p>
                    <p class="text-sm">{{ $property?->manager_phone }}</p>
                    <p class="mt-2 text-sm text-forest/70">{{ $property?->office_hours }}</p>
                </div>
            </div>
        </div>
    </div>
</x-layouts.public>
