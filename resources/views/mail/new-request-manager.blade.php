<x-mail::message>
# New tenant request

**{{ $tenantRequest->typeLabel() }}** from {{ $tenantRequest->name }} ({{ $tenantRequest->email }})

**Subject:** {{ $tenantRequest->subject }}

{{ $tenantRequest->body }}

Thanks,<br>
L&L Tenant Portal
</x-mail::message>
