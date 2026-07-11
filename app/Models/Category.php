<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Category extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
    ];

    /**
     * Get the products for the category.
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function getImageUrlAttribute()
    {
        if (!$this->image) {
            return null;
        }

        $image = str_replace('\\', '/', $this->image);
        $image = ltrim($image, '/');

        if (Str::startsWith($image, ['http://', 'https://'])) {
            return $image;
        }

        if (Str::startsWith($image, 'public/')) {
            $image = substr($image, 7);
        }

        if (Str::startsWith($image, ['uploads/', 'images/', 'storage/'])) {
            if (file_exists(public_path($image))) {
                return asset($image);
            }

            if (Str::startsWith($image, 'images/')) {
                $fallback = 'uploads/categories/' . basename($image);
                if (file_exists(public_path($fallback))) {
                    return asset($fallback);
                }
            }

            return asset($image);
        }

        if (Storage::disk('public')->exists($image)) {
            return Storage::url($image);
        }

        if (!Str::contains($image, '/')) {
            $uploadCandidate = 'uploads/categories/' . $image;
            if (file_exists(public_path($uploadCandidate))) {
                return asset($uploadCandidate);
            }

            $image = 'images/' . $image;
        }

        return asset($image);
    }
}
