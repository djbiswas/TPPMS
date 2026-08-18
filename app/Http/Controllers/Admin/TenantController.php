<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\TenantActivationNotification;
use App\Support\Company;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class TenantController extends Controller
{
    public function index(): View
    {
        return view('admin.tenants.index', [
            'tenants' => User::query()->where('role', User::ROLE_TENANT)->latest()->paginate(20),
        ]);
    }

    public function create(): View
    {
        return view('admin.tenants.create', [
            'property' => Company::property(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'phone' => ['nullable', 'string', 'max:40'],
        ]);

        $token = Str::random(48);
        $property = Company::property();

        $tenant = User::query()->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'] ?? null,
            'password' => Str::password(24),
            'role' => User::ROLE_TENANT,
            'status' => User::STATUS_PENDING,
            'activation_token' => $token,
            'property_id' => $property?->id,
        ]);

        $tenant->notify(new TenantActivationNotification($token));

        return redirect()->route('admin.tenants.index')->with('status', 'Tenant invited. Activation email sent.');
    }

    public function update(Request $request, User $tenant): RedirectResponse
    {
        abort_unless($tenant->isTenant(), 404);

        $data = $request->validate([
            'status' => ['required', 'in:active,suspended,pending_activation'],
        ]);

        $tenant->update(['status' => $data['status']]);

        return back()->with('status', 'Tenant status updated.');
    }
}
