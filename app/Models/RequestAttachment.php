<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RequestAttachment extends Model
{
    protected $fillable = [
        'tenant_request_id',
        'original_name',
        'path',
        'mime',
        'size',
    ];

    public function tenantRequest(): BelongsTo
    {
        return $this->belongsTo(TenantRequest::class);
    }
}
