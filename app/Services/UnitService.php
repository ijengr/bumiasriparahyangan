<?php

namespace App\Services;

use App\Models\Unit;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;

class UnitService
{
    /**
     * Get featured units for homepage
     *
     * @param int $limit
     * @return \Illuminate\Support\Collection|\Illuminate\Pagination\LengthAwarePaginator
     */
    public function getFeaturedUnits($limit = 6)
    {
        return Cache::remember("units.featured.{$limit}", 600, function () use ($limit) {
            if (!Schema::hasTable('units')) {
                return collect();
            }
            return Unit::latest()->paginate($limit);
        });
    }

    /**
     * Get all units with pagination
     *
     * @param int $perPage
     * @return \Illuminate\Support\Collection|\Illuminate\Pagination\LengthAwarePaginator
     */
    public function getAllUnits($perPage = 6)
    {
        if (!Schema::hasTable('units')) {
            return collect();
        }
        return Unit::latest()->paginate($perPage);
    }

    /**
     * Get unit by ID with related units
     *
     * @param int $id
     * @return array
     */
    public function getUnitWithRelated($id)
    {
        $unit = Unit::findOrFail($id);
        
        $relatedUnits = Cache::remember("units.related.{$id}", 600, function () use ($unit, $id) {
            return Unit::where('id', '!=', $id)
                ->where('type', $unit->type)
                ->latest()
                ->take(3)
                ->get();
        });

        return [
            'unit' => $unit,
            'relatedUnits' => $relatedUnits
        ];
    }

    /**
     * Get units by type
     *
     * @param string $type
     * @param int $limit
     * @return \Illuminate\Support\Collection
     */
    public function getUnitsByType($type, $limit = 10)
    {
        return Cache::remember("units.type.{$type}.{$limit}", 600, function () use ($type, $limit) {
            if (!Schema::hasTable('units')) {
                return collect();
            }
            return Unit::where('type', $type)
                ->latest()
                ->take($limit)
                ->get();
        });
    }

    /**
     * Search units
     *
     * @param array $filters
     * @param int $perPage
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function searchUnits(array $filters, $perPage = 12)
    {
        $query = Unit::query();

        if (!empty($filters['type'])) {
            $query->where('type', $filters['type']);
        }

        if (!empty($filters['min_price'])) {
            $query->where('price', '>=', $filters['min_price']);
        }

        if (!empty($filters['max_price'])) {
            $query->where('price', '<=', $filters['max_price']);
        }

        if (!empty($filters['bedrooms'])) {
            $query->where('bedrooms', '>=', $filters['bedrooms']);
        }

        if (!empty($filters['bathrooms'])) {
            $query->where('bathrooms', '>=', $filters['bathrooms']);
        }

        return $query->latest()->paginate($perPage);
    }

    /**
     * Clear all unit caches
     *
     * @return void
     */
    public function clearCache()
    {
        Cache::forget('units.featured.6');
        Cache::forget('homepage.units');
        // Clear other related caches as needed
    }
}
