<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\TenantRequest;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RequestController extends Controller
{
    public function index(Request $request): View
    {
        return view('tenant.requests.index', [
            'requests' => $request->user()->tenantRequests()->latest()->paginate(15),
        ]);
    }

    public function show(Request $request, TenantRequest $tenantRequest): View
    {
        $this->authorize('view', $tenantRequest);

        return view('tenant.requests.show', [
            'tenantRequest' => $tenantRequest->load('attachments', 'property'),
        ]);
    }
}
