<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\TenantRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RequestController extends Controller
{
    public function index(Request $request): View
    {
        $requests = TenantRequest::query()
            ->with('property')
            ->when($request->filled('status'), fn ($q) => $q->where('status', $request->string('status')))
            ->when($request->filled('type'), fn ($q) => $q->where('type', $request->string('type')))
            ->latest()
            ->paginate(20)
            ->withQueryString();

        return view('admin.requests.index', [
            'requests' => $requests,
            'types' => TenantRequest::TYPES,
        ]);
    }

    public function show(TenantRequest $tenantRequest): View
    {
        return view('admin.requests.show', [
            'tenantRequest' => $tenantRequest->load('attachments', 'property', 'user'),
        ]);
    }

    public function update(Request $request, TenantRequest $tenantRequest): RedirectResponse
    {
        $data = $request->validate([
            'status' => ['required', 'in:new,in_review,closed'],
            'internal_note' => ['nullable', 'string', 'max:5000'],
        ]);

        $tenantRequest->fill([
            'status' => $data['status'],
            'internal_note' => $data['internal_note'] ?? $tenantRequest->internal_note,
            'closed_at' => $data['status'] === TenantRequest::STATUS_CLOSED ? now() : null,
        ])->save();

        ActivityLog::query()->create([
            'user_id' => $request->user()->id,
            'action' => 'request.status',
            'subject_type' => TenantRequest::class,
            'subject_id' => $tenantRequest->id,
            'meta' => $data['status'],
        ]);

        return back()->with('status', 'Request updated.');
    }
}
