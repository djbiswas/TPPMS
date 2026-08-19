<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ImageProcessor;
use App\Support\Company;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SettingsController extends Controller
{
    public function edit(): View
    {
        $property = Company::property();

        return view('admin.settings', [
            'tab' => request('tab', 'branding'),
            'property' => $property,
            'site' => [
                'company_name' => Company::get('company_name', 'L&L International Ventures LLC'),
                'tagline' => Company::get('tagline', 'Professional management. Simple living.'),
                'meta_title' => Company::get('meta_title', 'L&L Tenant Portal'),
                'meta_description' => Company::get('meta_description', 'Your secure tenant portal for L&L International Ventures LLC.'),
                'meta_keywords' => Company::get('meta_keywords', ''),
                'logo' => Company::get('logo'),
                'favicon' => Company::get('favicon'),
                'og_image' => Company::get('og_image'),
                'property_hero' => Company::get('property_hero') ?: $property?->image_path,
            ],
            'zelle' => Company::get('zelle_handle', '@LLInternationalVentures'),
            'wire' => Company::get('wire_instructions'),
            'hours' => Company::get('office_hours', 'Mon - Fri | 9:00 AM - 5:00 PM'),
            'rentAmount' => Company::get('rent_amount', '2375.00'),
            'dueDate' => Company::get('next_due_date', 'May 1, 2025'),
        ]);
    }

    public function update(Request $request, ImageProcessor $images): RedirectResponse
    {
        $data = $request->validate([
            'company_name' => ['required', 'string', 'max:180'],
            'tagline' => ['nullable', 'string', 'max:180'],
            'meta_title' => ['nullable', 'string', 'max:180'],
            'meta_description' => ['nullable', 'string', 'max:500'],
            'meta_keywords' => ['nullable', 'string', 'max:255'],
            'zelle_handle' => ['required', 'string', 'max:80'],
            'wire_instructions' => ['nullable', 'string', 'max:5000'],
            'office_hours' => ['nullable', 'string', 'max:120'],
            'manager_email' => ['required', 'email'],
            'manager_phone' => ['required', 'string', 'max:40'],
            'rent_amount' => ['required', 'numeric', 'min:0'],
            'next_due_date' => ['required', 'string', 'max:80'],
            'logo' => ['nullable', 'image', 'max:5120'],
            'favicon' => ['nullable', 'image', 'max:2048'],
            'og_image' => ['nullable', 'image', 'max:5120'],
            'property_hero' => ['nullable', 'image', 'max:8192'],
            'logo_data' => ['nullable', 'string'],
            'favicon_data' => ['nullable', 'string'],
            'og_image_data' => ['nullable', 'string'],
            'property_hero_data' => ['nullable', 'string'],
        ]);

        foreach (['company_name', 'tagline', 'meta_title', 'meta_description', 'meta_keywords', 'zelle_handle', 'wire_instructions', 'office_hours', 'rent_amount', 'next_due_date'] as $key) {
            Company::put($key, (string) ($data[$key] ?? ''));
        }

        $this->saveImage($images, $request, 'logo', 'site/logo', 800, 400, false, 'png');
        $this->saveImage($images, $request, 'favicon', 'site/favicon', 512, 512, true, 'png');
        $this->saveImage($images, $request, 'og_image', 'site/og', 1200, 630, true, 'jpg');
        $hero = $this->saveImage($images, $request, 'property_hero', 'site/hero', 1920, 1080, true, 'jpg');

        $property = Company::property();
        if ($property) {
            $payload = [
                'manager_email' => $data['manager_email'],
                'manager_phone' => $data['manager_phone'],
                'office_hours' => $data['office_hours'] ?? $property->office_hours,
            ];
            if ($hero) {
                $payload['image_path'] = $hero;
            }
            $property->update($payload);
        }

        Company::forget();

        return back()->with('status', 'Settings saved.');
    }

    private function saveImage(ImageProcessor $images, Request $request, string $field, string $dir, int $w, int $h, bool $cover, string $format): ?string
    {
        if ($request->boolean($field.'_remove')) {
            Company::put($field, null);

            return null;
        }

        $path = $images->store($request->input($field.'_data') ?: $request->file($field), $dir, $w, $h, $cover, $format);
        if ($path) {
            Company::put($field, $path);
        }

        return $path;
    }
}
