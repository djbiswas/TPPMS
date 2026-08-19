<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Page extends Model
{
    public const PROTECTED_SLUGS = ['privacy', 'terms'];

    protected $fillable = [
        'slug',
        'title',
        'body',
        'meta_title',
        'meta_description',
        'og_image',
        'is_published',
    ];

    protected function casts(): array
    {
        return [
            'is_published' => 'boolean',
        ];
    }

    public function isProtected(): bool
    {
        return in_array($this->slug, self::PROTECTED_SLUGS, true);
    }

    public function ogImageUrl(): ?string
    {
        if (! $this->og_image) {
            return null;
        }

        if (str_starts_with($this->og_image, 'http') || str_starts_with($this->og_image, 'images/')) {
            return asset($this->og_image);
        }

        return Storage::disk('public')->url($this->og_image);
    }
}
