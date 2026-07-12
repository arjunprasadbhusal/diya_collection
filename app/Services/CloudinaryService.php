<?php

namespace App\Services;

use Cloudinary\Cloudinary;

class CloudinaryService
{
    protected $cloudinary;

    public function __construct()
    {
        $this->cloudinary = new Cloudinary(env('CLOUDINARY_URL'));
    }

    public function upload($filePath)
    {
        $result = $this->cloudinary->uploadApi()->upload($filePath);
        return $result['secure_url'];
    }
}