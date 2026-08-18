<x-layouts.public title="Contact Us — L&L Tenant Portal">
    <div class="mx-auto max-w-6xl px-4 py-12">
        <h1 class="font-serif text-4xl text-forest">Contact Us</h1>
        <div class="mt-2 h-1 w-16 bg-gold"></div>
        <p class="mt-4 max-w-2xl text-forest/80">We're here to help! Please fill out the form below and we will get back to you as soon as possible.</p>

        <div class="mt-10 grid gap-8 lg:grid-cols-3">
            <div class="lg:col-span-2">
            <div class="card p-6">
                <form method="POST" action="{{ route('contact.store') }}" enctype="multipart/form-data" class="space-y-5" x-data="{ type: '{{ old('type', 'maintenance') }}' }">
                    @csrf
                    <div>
                        <label class="label-caps">Request type *</label>
                        <select name="type" x-model="type" class="mt-1 w-full rounded-lg border-gray-300" required>
                            @foreach ($types as $value => $label)
                                <option value="{{ $value }}">{{ $label }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('type')" class="mt-1" />
                    </div>
                    <div>
                        <label class="label-caps">Subject *</label>
                        <input name="subject" value="{{ old('subject') }}" class="mt-1 w-full rounded-lg border-gray-300" placeholder="Enter a short subject" required>
                        <x-input-error :messages="$errors->get('subject')" class="mt-1" />
                    </div>
                    <div>
                        <label class="label-caps">Description *</label>
                        <textarea name="body" rows="5" class="mt-1 w-full rounded-lg border-gray-300" placeholder="Please provide details about your request..." required>{{ old('body') }}</textarea>
                        <x-input-error :messages="$errors->get('body')" class="mt-1" />
                    </div>
                    <div class="grid gap-4 md:grid-cols-2">
                        <div>
                            <label class="label-caps">Your name *</label>
                            <input name="name" value="{{ old('name', $user?->name) }}" class="mt-1 w-full rounded-lg border-gray-300" required>
                        </div>
                        <div>
                            <label class="label-caps">Preferred contact</label>
                            <select name="preferred_contact" class="mt-1 w-full rounded-lg border-gray-300">
                                <option value="email">Email</option>
                                <option value="phone">Phone</option>
                            </select>
                        </div>
                    </div>
                    <div class="grid gap-4 md:grid-cols-2">
                        <div>
                            <label class="label-caps">Your email *</label>
                            <input type="email" name="email" value="{{ old('email', $user?->email) }}" class="mt-1 w-full rounded-lg border-gray-300" required>
                        </div>
                        <div>
                            <label class="label-caps">Phone number</label>
                            <input name="phone" value="{{ old('phone', $user?->phone) }}" class="mt-1 w-full rounded-lg border-gray-300" placeholder="(512) 123-4567">
                        </div>
                    </div>
                    <div>
                        <label class="label-caps">Property / unit</label>
                        <input name="unit" value="{{ old('unit', $property?->fullAddress()) }}" class="mt-1 w-full rounded-lg border-gray-300">
                    </div>
                    <div x-show="['maintenance','work_order','urgent'].includes(type)" class="grid gap-4 md:grid-cols-2">
                        <div>
                            <label class="label-caps">Priority</label>
                            <select name="priority" class="mt-1 w-full rounded-lg border-gray-300">
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
                    <button class="btn-primary w-full"><x-icon name="envelope" class="h-4 w-4" /> Submit request</button>
                </form>
            </div>
            @if (session('status'))
                <div class="mt-6 flex items-start gap-3 rounded-2xl bg-gray-100 p-4 text-sm text-forest">
                    <x-icon name="check" class="mt-0.5 h-6 w-6 shrink-0 text-green-600" />
                    <p>{{ session('status') }}</p>
                </div>
            @endif
            </div>

            <div class="space-y-6">
                <div class="card overflow-hidden">
                    <img src="{{ asset('images/property-hero.jpg') }}" alt="Property" class="h-44 w-full object-cover">
                    <div class="p-4">
                        <p class="font-semibold">{{ $property?->fullAddress() }}</p>
                        <p class="mt-1 flex items-center gap-2 text-sm text-forest/70"><x-icon name="lock" class="h-4 w-4 text-gold" /> {{ $property?->type }}</p>
                    </div>
                </div>
                <div class="card p-5">
                    <h2 class="label-caps">Pay your rent</h2>
                    <p class="mt-1 text-sm text-forest/70">Choose your preferred payment method.</p>
                    <div class="mt-4 rounded-xl bg-gray-50 p-4">
                        <p class="text-sm font-semibold">Pay with Zelle</p>
                        <p class="text-zelle">Username: {{ $zelleHandle }}</p>
                        <p class="mt-1 text-xs text-forest/60">Search our username in your banking app.</p>
                    </div>
                    <div class="my-3 flex items-center gap-3 text-xs uppercase tracking-wide text-forest/40"><span class="h-px flex-1 bg-gray-200"></span> or <span class="h-px flex-1 bg-gray-200"></span></div>
                    <div class="rounded-xl bg-gray-50 p-4">
                        <p class="flex items-center gap-2 text-sm font-semibold"><x-icon name="card" class="h-5 w-5" /> Pay with Credit or Debit Card</p>
                        <p class="mt-1 text-xs text-forest/60">Pay securely online using your credit or debit card.</p>
                        <span class="btn-primary mt-3 w-full cursor-not-allowed text-xs opacity-70"><x-icon name="lock" class="h-4 w-4" /> Pay with Card</span>
                        <p class="mt-3 text-center text-[10px] tracking-wide text-forest/40">VISA · MASTERCARD · AMEX · DISCOVER</p>
                    </div>
                    <p class="mt-4 flex items-center gap-2 text-xs text-forest/50"><x-icon name="lock" class="h-3.5 w-3.5 text-gold" /> All payments are secure and encrypted.</p>
                </div>
                <div class="card p-5">
                    <h2 class="label-caps">Property manager</h2>
                    <p class="mt-3 flex items-center gap-2 font-semibold"><x-icon name="user" class="h-5 w-5 text-gold" /> {{ $property?->manager_name }}</p>
                    <p class="text-sm">{{ $property?->manager_title }}</p>
                    <p class="mt-2 flex items-center gap-2 text-sm"><x-icon name="envelope" class="h-4 w-4 text-gold" /> {{ $property?->manager_email }}</p>
                    <p class="flex items-center gap-2 text-sm"><x-icon name="phone" class="h-4 w-4 text-gold" /> {{ $property?->manager_phone }}</p>
                    <p class="mt-2 text-sm text-forest/70">{{ $property?->office_hours }}</p>
                </div>
            </div>
        </div>
    </div>
</x-layouts.public>
