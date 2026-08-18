<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\WebfixLicenseClient;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LicenseController extends Controller
{
    public function edit(WebfixLicenseClient $client): View
    {
        return view('license.edit', [
            'state' => $client->currentState(),
            'item' => config('webfix.item'),
            'domain' => $client->domain(),
        ]);
    }

    public function update(Request $request, WebfixLicenseClient $client): RedirectResponse
    {
        $data = $request->validate([
            'key' => ['required', 'string', 'max:191'],
        ]);

        $path = base_path('.env');
        if (is_writable($path)) {
            $env = file_get_contents($path);
            if (preg_match('/^WEBFIX_LICENSE_KEY=.*$/m', (string) $env)) {
                $env = preg_replace('/^WEBFIX_LICENSE_KEY=.*$/m', 'WEBFIX_LICENSE_KEY='.$data['key'], (string) $env);
            } else {
                $env .= PHP_EOL.'WEBFIX_LICENSE_KEY='.$data['key'].PHP_EOL;
            }
            file_put_contents($path, $env);
        }

        config(['webfix.key' => $data['key']]);
        $result = $client->activate($data['key']);

        return back()->with('status', $result['message'] ?? 'License updated.')->with('license_valid', $result['valid'] ?? false);
    }
}
