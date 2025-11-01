<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Cache;

class CacheHelper
{
    /**
     * Clear homepage cache
     */
    public static function clearHomepageCache(): void
    {
        Cache::forget('homepage.units');
        Cache::forget('homepage.facilities');
        Cache::forget('homepage.gallery');
    }

    /**
     * Clear units cache
     */
    public static function clearUnitsCache(): void
    {
        Cache::forget('homepage.units');
    }

    /**
     * Clear facilities cache
     */
    public static function clearFacilitiesCache(): void
    {
        Cache::forget('homepage.facilities');
    }

    /**
     * Clear gallery cache
     */
    public static function clearGalleryCache(): void
    {
        Cache::forget('homepage.gallery');
    }

    /**
     * Clear settings cache
     */
    public static function clearSettingsCache(): void
    {
        Cache::forget('settings');
    }

    /**
     * Clear all application cache
     */
    public static function clearAll(): void
    {
        self::clearHomepageCache();
        self::clearSettingsCache();
    }
}
