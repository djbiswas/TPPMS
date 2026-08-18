<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TenantRequest extends Model
{
    public const STATUS_NEW = 'new';

    public const STATUS_IN_REVIEW = 'in_review';

    public const STATUS_CLOSED = 'closed';

    public const TYPES = [
        'general' => 'General inquiry',
        'maintenance' => 'Maintenance request',
        'work_order' => 'Work order',
        'payment' => 'Rent payment / payment issue',
        'late_rent' => 'Late rent',
        'urgent' => 'Urgent request',
        'other' => 'Other',
    ];

    protected $fillable = [
        'property_id',
        'user_id',
        'type',
        'subject',
        'body',
        'name',
        'email',
        'phone',
        'unit',
        'preferred_contact',
        'priority',
        'permission_to_enter',
        'status',
        'internal_note',
        'closed_at',
    ];

    protected function casts(): array
    {
        return [
            'permission_to_enter' => 'boolean',
            'closed_at' => 'datetime',
        ];
    }

    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function attachments(): HasMany
    {
        return $this->hasMany(RequestAttachment::class);
    }

    public function typeLabel(): string
    {
        return self::TYPES[$this->type] ?? $this->type;
    }

    public function needsMaintenanceFields(): bool
    {
        return in_array($this->type, ['maintenance', 'work_order', 'urgent'], true);
    }
}
