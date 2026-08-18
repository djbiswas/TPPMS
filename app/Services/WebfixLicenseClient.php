<?php

namespace App\Services;

use App\Models\LicenseState;
use Illuminate\Support\Facades\Http;

class WebfixLicenseClient
{
    public function domain(): string
    {
        $host = strtolower((string) parse_url(config('app.url'), PHP_URL_HOST) ?: request()->getHost());
        $host = preg_replace('#^www\.#', '', $host) ?? $host;

        return explode(':', $host)[0];
    }

    public function activate(?string $key = null): array
    {
        return $this->call('activate', $key);
    }

    public function validate(?string $key = null): array
    {
        return $this->call('validate', $key);
    }

    public function deactivate(?string $key = null): array
    {
        return $this->call('deactivate', $key);
    }

    public function isValid(): bool
    {
        if (config('webfix.bypass')) {
            return true;
        }

        $state = LicenseState::query()->latest('id')->first();

        if ($state && $state->valid && $state->checked_at && $state->checked_at->gt(now()->subSeconds((int) config('webfix.cache_ttl')))) {
            return true;
        }

        $result = $this->validate();

        if (! empty($result['valid'])) {
            return true;
        }

        if ($state?->valid && $state->checked_at?->gt(now()->subHours((int) config('webfix.grace_hours')))) {
            return true;
        }

        return false;
    }

    public function currentState(): ?LicenseState
    {
        return LicenseState::query()->latest('id')->first();
    }

    /**
     * @return array<string, mixed>
     */
    private function call(string $action, ?string $key = null): array
    {
        $key = $key ?: (string) config('webfix.key');
        $payload = [
            'key' => $key,
            'domain' => $this->domain(),
            'item' => (string) config('webfix.item'),
            'version' => (string) config('webfix.version'),
        ];

        try {
            $response = Http::asForm()->timeout(8)->post(rtrim((string) config('webfix.api'), '/').'/'.$action, $payload);
            $body = $response->json() ?? [];
        } catch (\Throwable $e) {
            return ['valid' => false, 'status' => 'unreachable', 'message' => $e->getMessage()];
        }

        if (! is_array($body) || ! $this->verifySignature($body)) {
            return ['valid' => false, 'status' => 'bad_signature', 'message' => 'License server response failed verification.'];
        }

        LicenseState::query()->create([
            'valid' => (bool) ($body['valid'] ?? false),
            'status' => $body['status'] ?? null,
            'message' => $body['message'] ?? null,
            'expires' => $body['expires'] ?? null,
            'checked_at' => now(),
        ]);

        return $body;
    }

    /**
     * @param  array<string, mixed>  $body
     */
    private function verifySignature(array $body): bool
    {
        $secret = (string) config('webfix.secret');
        if ($secret === '' || empty($body['signature'])) {
            return $secret === '';
        }

        $signature = $body['signature'];
        unset($body['signature']);
        ksort($body);

        $expected = hash_hmac('sha256', json_encode($body), $secret);

        return hash_equals($expected, $signature);
    }
}
