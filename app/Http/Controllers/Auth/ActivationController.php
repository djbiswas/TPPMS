<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class ActivationController extends Controller
{
    public function show(string $token): View
    {
        $user = User::query()->where('activation_token', $token)->where('status', User::STATUS_PENDING)->firstOrFail();

        return view('auth.activate', compact('user', 'token'));
    }

    public function store(Request $request, string $token): RedirectResponse
    {
        $user = User::query()->where('activation_token', $token)->where('status', User::STATUS_PENDING)->firstOrFail();

        $request->validate([
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $user->forceFill([
            'password' => $request->password,
            'status' => User::STATUS_ACTIVE,
            'activation_token' => null,
            'email_verified_at' => now(),
        ])->save();

        event(new Verified($user));
        Auth::login($user);

        return redirect()->route('tenant.dashboard');
    }
}
