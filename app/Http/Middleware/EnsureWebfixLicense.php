<?php

namespace App\Http\Middleware;

use App\Services\WebfixLicenseClient;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureWebfixLicense
{
    public function handle(Request $request, Closure $next): Response
    {
        if (config('webfix.bypass') || $request->routeIs('license.*', 'up')) {
            return $next($request);
        }

        if (app(WebfixLicenseClient::class)->isValid()) {
            return $next($request);
        }

        if ($request->user()?->isAdmin()) {
            return redirect()->route('license.edit')->with('status', 'A valid WebFix Team license is required.');
        }

        return response()->view('license.locked', [], 403);
    }
}
