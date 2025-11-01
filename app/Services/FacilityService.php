<?php

namespace App\Services;

use App\Models\Facility;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;

class FacilityService
{
    /**
     * Get all facilities
     *
     * @return \Illuminate\Support\Collection|\Illuminate\Pagination\LengthAwarePaginator
     */
    public function getAllFacilities()
    {
        return Cache::remember('facilities.all', 600, function () {
            if (!Schema::hasTable('facilities')) {
                return collect();
            }
            return Facility::latest()->get();
        });
    }

    /**
     * Get featured facilities for homepage
     *
     * @param int $limit
     * @return \Illuminate\Support\Collection|\Illuminate\Pagination\LengthAwarePaginator
     */
    public function getFeaturedFacilities($limit = 20)
    {
        return Cache::remember("facilities.featured.{$limit}", 600, function () use ($limit) {
            if (!Schema::hasTable('facilities')) {
                return collect();
            }
            return Facility::latest()->paginate($limit);
        });
    }

    /**
     * Clear facility caches
     *
     * @return void
     */
    public function clearCache()
    {
        Cache::forget('facilities.all');
        Cache::forget('homepage.facilities');
    }
}
