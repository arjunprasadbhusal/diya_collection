<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'price',
        'image',
        'stock',
    ];

    /**
     * Get the category that owns the product.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getImageUrlAttribute()
    {
        if (!$this->image) {
            return null;
        }

        $image = str_replace('\\', '/', $this->image);
        $image = ltrim($image, '/');

        if (Str::startsWith($image, ['http://', 'https://'])) {
            return $this->versionedImageUrl($image);
        }

        if (Str::startsWith($image, 'public/')) {
            $image = substr($image, 7);
        }

        if (Str::startsWith($image, ['uploads/', 'images/', 'storage/'])) {
            if (file_exists(public_path($image))) {
                return $this->versionedImageUrl(asset($image));
            }

            if (Str::startsWith($image, 'images/')) {
                $fallback = 'uploads/products/' . basename($image);
                if (file_exists(public_path($fallback))) {
                    return $this->versionedImageUrl(asset($fallback));
                }
            }

            return $this->versionedImageUrl(asset($image));
        }

        if (Storage::disk('public')->exists($image)) {
            return $this->versionedImageUrl(Storage::url($image));
        }

        if (!Str::contains($image, '/')) {
            $uploadCandidate = 'uploads/products/' . $image;
            if (file_exists(public_path($uploadCandidate))) {
                return $this->versionedImageUrl(asset($uploadCandidate));
            }

            $image = 'images/' . $image;
        }

        return $this->versionedImageUrl(asset($image));
    }

    private function versionedImageUrl(string $url): string
    {
        $version = $this->updated_at?->getTimestamp() ?? now()->getTimestamp();

        return $url . (Str::contains($url, '?') ? '&' : '?') . 'v=' . $version;
    }
}
