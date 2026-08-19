<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Encoders\JpegEncoder;
use Intervention\Image\Encoders\PngEncoder;
use Intervention\Image\Encoders\WebpEncoder;
use Intervention\Image\ImageManager;

class ImageProcessor
{
    public function store(
        UploadedFile|string|null $input,
        string $directory,
        int $maxWidth,
        int $maxHeight,
        bool $cover = false,
        string $format = 'jpg',
    ): ?string {
        $binary = $this->toBinary($input);
        if ($binary === null) {
            return null;
        }

        $manager = new ImageManager(new Driver);
        $image = $manager->decode($binary);

        if ($cover) {
            $image->cover($maxWidth, $maxHeight);
        } else {
            $image->scaleDown($maxWidth, $maxHeight);
        }

        $encoder = match ($format) {
            'png' => new PngEncoder,
            'webp' => new WebpEncoder(quality: 85),
            default => new JpegEncoder(quality: 85),
        };

        $encoded = $image->encode($encoder);
        $name = $directory.'/'.Str::uuid().'.'.$format;
        Storage::disk('public')->put($name, (string) $encoded);

        return $name;
    }

    private function toBinary(UploadedFile|string|null $input): ?string
    {
        if ($input instanceof UploadedFile && $input->isValid()) {
            return file_get_contents($input->getRealPath()) ?: null;
        }

        if (! is_string($input) || $input === '') {
            return null;
        }

        if (str_starts_with($input, 'data:image')) {
            $parts = explode(',', $input, 2);

            return isset($parts[1]) ? base64_decode($parts[1]) : null;
        }

        return null;
    }
}
