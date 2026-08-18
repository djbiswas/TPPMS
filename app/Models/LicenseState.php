<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LicenseState extends Model
{
    protected $fillable = ['valid', 'status', 'message', 'expires', 'checked_at'];

    protected function casts(): array
    {
        return [
            'valid' => 'boolean',
            'checked_at' => 'datetime',
        ];
    }
}
