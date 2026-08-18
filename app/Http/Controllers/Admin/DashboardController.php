<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TenantRequest;
use App\Models\User;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        return view('admin.dashboard', [
            'newCount' => TenantRequest::query()->where('status', TenantRequest::STATUS_NEW)->count(),
            'reviewCount' => TenantRequest::query()->where('status', TenantRequest::STATUS_IN_REVIEW)->count(),
            'tenantCount' => User::query()->where('role', User::ROLE_TENANT)->count(),
            'recent' => TenantRequest::query()->latest()->limit(8)->get(),
        ]);
    }
}
