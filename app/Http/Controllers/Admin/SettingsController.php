<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Support\Company;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SettingsController extends Controller
{
    public function edit(): View
    {
        return view('admin.settings', [
            'property' => Company::property(),
            'zelle' => Company::get('zelle_handle', '@LLInternationalVentures'),
            'wire' => Company::get('wire_instructions'),
            'hours' => Company::get('office_hours', 'Mon - Fri | 9:00 AM - 5:00 PM'),
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'zelle_handle' => ['required', 'string', 'max:80'],
            'wire_instructions' => ['nullable', 'string', 'max:5000'],
            'office_hours' => ['nullable', 'string', 'max:120'],
            'manager_email' => ['required', 'email'],
            'manager_phone' => ['required', 'string', 'max:40'],
        ]);

        Company::put('zelle_handle', $data['zelle_handle']);
        Company::put('wire_instructions', $data['wire_instructions'] ?? '');
        Company::put('office_hours', $data['office_hours'] ?? '');

        $property = Company::property();
        if ($property) {
            $property->update([
                'manager_email' => $data['manager_email'],
                'manager_phone' => $data['manager_phone'],
                'office_hours' => $data['office_hours'] ?? $property->office_hours,
            ]);
            Company::forget();
        }

        return back()->with('status', 'Settings saved.');
    }
}
