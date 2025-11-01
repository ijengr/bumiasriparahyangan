<?php

namespace App\Helpers;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\Storage;

class ImageHelper
{
    /**
     * Compress and save image with optimal quality
     * Automatically converts to WebP for better compression
     * 
     * @param \Illuminate\Http\UploadedFile $file
     * @param string $path Directory path (e.g., 'units', 'gallery', 'avatars')
     * @param int $maxWidth Maximum width (default: 1920)
     * @param int $quality Quality percentage (default: 85)
     * @param bool $convertToWebP Convert to WebP format (default: true)
     * @return string Saved file path
     */
    public static function compressAndSave($file, $path = 'images', $maxWidth = 1920, $quality = 85, $convertToWebP = true)
    {
        // Generate unique filename
        $extension = $convertToWebP ? 'webp' : $file->getClientOriginalExtension();
        $filename = time() . '_' . uniqid() . '.' . $extension;
        $fullPath = $path . '/' . $filename;
        
        // Create image manager with GD driver
        $manager = new ImageManager(new Driver());
        
        // Read and process image
        $image = $manager->read($file);
        
        // Get original dimensions
        $originalWidth = $image->width();
        $originalHeight = $image->height();
        
        // Resize if larger than max width (maintain aspect ratio)
        if ($originalWidth > $maxWidth) {
            $newHeight = (int) ($originalHeight * ($maxWidth / $originalWidth));
            $image->resize($maxWidth, $newHeight);
        }
        
        // Encode with format and quality
        if ($convertToWebP) {
            $encoded = $image->toWebp($quality);
        } else {
            $encoded = $image->encode();
        }
        
        // Save to storage
        Storage::disk('public')->put($fullPath, (string) $encoded);
        
        return $fullPath;
    }
    
    /**
     * Create thumbnail version
     * Automatically converts to WebP for better compression
     * 
     * @param \Illuminate\Http\UploadedFile $file
     * @param string $path Directory path
     * @param int $width Thumbnail width
     * @param int $height Thumbnail height
     * @param int $quality Quality percentage
     * @param bool $convertToWebP Convert to WebP format (default: true)
     * @return string Saved file path
     */
    public static function createThumbnail($file, $path = 'images/thumbnails', $width = 300, $height = 300, $quality = 80, $convertToWebP = true)
    {
        $extension = $convertToWebP ? 'webp' : $file->getClientOriginalExtension();
        $filename = time() . '_thumb_' . uniqid() . '.' . $extension;
        $fullPath = $path . '/' . $filename;
        
        // Create image manager
        $manager = new ImageManager(new Driver());
        
        // Read and process image
        $image = $manager->read($file);
        
        // Cover (crop to exact dimensions)
        $image->cover($width, $height);
        
        // Encode with format
        if ($convertToWebP) {
            $encoded = $image->toWebp($quality);
        } else {
            $encoded = $image->encode();
        }
        
        // Save to storage
        Storage::disk('public')->put($fullPath, (string) $encoded);
        
        return $fullPath;
    }
    
    /**
     * Delete image from storage
     * 
     * @param string|null $path
     * @return bool
     */
    public static function delete($path)
    {
        if ($path && Storage::disk('public')->exists($path)) {
            return Storage::disk('public')->delete($path);
        }
        
        return false;
    }
}
