<?php

namespace App\Services;

use Cloudinary\Cloudinary;
use Cloudinary\Configuration\Configuration;

class CloudinaryService
{
    protected $cloudinary;

    public function __construct()
    {
        $this->cloudinary = new Cloudinary([
            'cloud' => [
                'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
                'api_key'    => env('CLOUDINARY_API_KEY'),
                'api_secret' => env('CLOUDINARY_API_SECRET'),
            ],
            'url' => [
                'secure' => true
            ]
        ]);
    }

    /**
     * Upload a file to Cloudinary.
     *
     * @param string $file The path to the file or a base64 encoded string.
     * @param string $folder The folder to store the file in.
     * @return string The secure URL of the uploaded file.
     */
    public function upload($file, $folder = 'laporans')
    {
        $upload = $this->cloudinary->uploadApi()->upload($file, [
            'folder' => $folder,
        ]);

        return $upload['secure_url'];
    }

    /**
     * Delete a file from Cloudinary.
     *
     * @param string $publicId The public ID of the file to delete.
     * @return bool
     */
    public function delete($publicId)
    {
        try {
            $this->cloudinary->uploadApi()->destroy($publicId);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}
