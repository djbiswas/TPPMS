<?php

namespace App\Http\Controllers;

use App\Mail\NewRequestToManager;
use App\Mail\RequestReceivedConfirmation;
use App\Models\RequestAttachment;
use App\Models\TenantRequest;
use App\Support\Company;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function create(Request $request): View
    {
        return view('public.contact', [
            'property' => Company::property(),
            'types' => TenantRequest::TYPES,
            'user' => $request->user(),
        ]);
    }

    public function store(Request $http): RedirectResponse
    {
        $property = Company::property();
        abort_unless($property, 500, 'Property is not configured.');

        $data = $http->validate([
            'type' => ['required', 'in:'.implode(',', array_keys(TenantRequest::TYPES))],
            'subject' => ['required', 'string', 'max:255'],
            'body' => ['required', 'string', 'max:5000'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:40'],
            'unit' => ['nullable', 'string', 'max:80'],
            'preferred_contact' => ['required', 'in:email,phone'],
            'priority' => ['nullable', 'in:normal,high,urgent'],
            'permission_to_enter' => ['sometimes', 'boolean'],
            'attachment' => ['nullable', 'file', 'max:5120', 'mimes:jpg,jpeg,png,pdf,webp'],
        ]);

        $tenantRequest = TenantRequest::query()->create([
            'property_id' => $property->id,
            'user_id' => $http->user()?->id,
            'type' => $data['type'],
            'subject' => $data['subject'],
            'body' => $data['body'],
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'] ?? null,
            'unit' => $data['unit'] ?? $property->address_line,
            'preferred_contact' => $data['preferred_contact'],
            'priority' => $data['priority'] ?? null,
            'permission_to_enter' => $http->boolean('permission_to_enter'),
            'status' => TenantRequest::STATUS_NEW,
        ]);

        if ($http->hasFile('attachment')) {
            $file = $http->file('attachment');
            $path = $file->store('request-attachments', 'local');
            RequestAttachment::query()->create([
                'tenant_request_id' => $tenantRequest->id,
                'original_name' => $file->getClientOriginalName(),
                'path' => $path,
                'mime' => $file->getClientMimeType(),
                'size' => $file->getSize(),
            ]);
        }

        Mail::to($property->manager_email)->send(new NewRequestToManager($tenantRequest));
        Mail::to($tenantRequest->email)->send(new RequestReceivedConfirmation($tenantRequest));

        return back()->with('status', 'Thank you! Your request has been received. We will review it and respond as quickly as possible.');
    }

    public function download(Request $http, RequestAttachment $attachment)
    {
        $this->authorize('download', $attachment->tenantRequest);

        abort_unless(Storage::disk('local')->exists($attachment->path), 404);

        return Storage::disk('local')->download($attachment->path, $attachment->original_name);
    }
}
