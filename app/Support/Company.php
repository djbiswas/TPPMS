<?php

namespace App\Support;

use App\Models\Property;
use App\Models\Setting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class Company
{
    public static function get(string $key, mixed $default = null): mixed
    {
        try {
            $settings = Cache::remember('app_settings', 60, function () {
                return Setting::query()->pluck('value', 'key')->all();
            });

            if (! is_array($settings)) {
                $settings = collect($settings)->all();
            }

            return $settings[$key] ?? $default;
        } catch (\Throwable) {
            return $default;
        }
    }

    public static function put(string $key, ?string $value): void
    {
        Setting::query()->updateOrCreate(['key' => $key], ['value' => $value]);
        Cache::forget('app_settings');
    }

    public static function property(): ?Property
    {
        try {
            return Cache::remember('primary_property', 60, fn () => Property::query()->first());
        } catch (\Throwable) {
            return null;
        }
    }

    public static function forget(): void
    {
        Cache::forget('app_settings');
        Cache::forget('primary_property');
    }

    public static function mediaUrl(?string $path, ?string $fallback = null): ?string
    {
        $path = $path ?: $fallback;
        if (! $path) {
            return null;
        }
        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://') || str_starts_with($path, '/')) {
            return $path;
        }
        if (str_starts_with($path, 'images/') || str_starts_with($path, 'build/')) {
            return asset($path);
        }

        return Storage::disk('public')->url($path);
    }
}
