<?php

namespace App\Services;

use App\Models\GalleryImage;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;

class GalleryService
{
    /**
     * Get featured gallery images for homepage
     *
     * @param int $limit
     * @return \Illuminate\Support\Collection
     */
    public function getFeaturedImages($limit = 4)
    {
        return Cache::remember("gallery.featured.{$limit}", 600, function () use ($limit) {
            if (!Schema::hasTable('gallery_images')) {
                return collect();
            }
            return GalleryImage::latest()->take($limit)->get();
        });
    }

    /**
     * Get all gallery images with pagination
     *
     * @param int $perPage
     * @return \Illuminate\Support\Collection|\Illuminate\Pagination\LengthAwarePaginator
     */
    public function getAllImages($perPage = 12)
    {
        if (!Schema::hasTable('gallery_images')) {
            return collect();
        }
        return GalleryImage::latest()->paginate($perPage);
    }

    /**
     * Get random images for hero rotator
     *
     * @param int $count
     * @return \Illuminate\Support\Collection
     */
    public function getRandomImages($count = 6)
    {
        if (!Schema::hasTable('gallery_images')) {
            return collect();
        }
        return GalleryImage::inRandomOrder()->take($count)->get();
    }

    /**
     * Clear gallery caches
     *
     * @return void
     */
    public function clearCache()
    {
        Cache::forget('gallery.featured.4');
        Cache::forget('homepage.gallery');
    }
}
