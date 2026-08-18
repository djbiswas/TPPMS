<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Property extends Model
{
    protected $fillable = [
        'name',
        'address_line',
        'city',
        'state',
        'postal_code',
        'type',
        'image_path',
        'manager_name',
        'manager_title',
        'manager_email',
        'manager_phone',
        'office_hours',
    ];

    public function fullAddress(): string
    {
        return "{$this->address_line}, {$this->city}, {$this->state} {$this->postal_code}";
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function tenantRequests(): HasMany
    {
        return $this->hasMany(TenantRequest::class);
    }
}
