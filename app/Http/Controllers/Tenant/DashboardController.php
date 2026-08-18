<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Support\Company;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(Request $request): View
    {
        $user = $request->user();

        return view('tenant.dashboard', [
            'property' => $user->property ?: Company::property(),
            'requests' => $user->tenantRequests()->latest()->limit(8)->get(),
        ]);
    }
}
