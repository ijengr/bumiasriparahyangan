<?php

namespace App\Helpers;

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;

class ThemeHelper
{
    /**
     * Get theme color value
     */
    public static function getThemeValue(string $key, string $default = ''): string
    {
        $settings = Cache::remember('theme_settings', 3600, function () {
            return Setting::pluck('value', 'key');
        });
        
        return $settings[$key] ?? $default;
    }
    
    /**
     * Generate CSS variables from theme settings
     */
    public static function generateCSSVariables(): string
    {
        // Cache theme settings for 1 hour
        $settings = Cache::remember('theme_settings', 3600, function () {
            return Setting::pluck('value', 'key');
        });
        
        $primary = $settings['theme_primary_color'] ?? '#059669';
        $secondary = $settings['theme_secondary_color'] ?? '#0d9488';
        $accent = $settings['theme_accent_color'] ?? '#3b82f6';
        $success = $settings['theme_success_color'] ?? '#10b981';
        $warning = $settings['theme_warning_color'] ?? '#f59e0b';
        $danger = $settings['theme_danger_color'] ?? '#ef4444';
        $text = $settings['theme_text_color'] ?? '#1f2937';
        $bg = $settings['theme_background_color'] ?? '#ffffff';
        $radius = $settings['theme_border_radius'] ?? '16';
        
        return <<<CSS
:root {
    --theme-primary: {$primary};
    --theme-secondary: {$secondary};
    --theme-accent: {$accent};
    --theme-success: {$success};
    --theme-warning: {$warning};
    --theme-danger: {$danger};
    --theme-text: {$text};
    --theme-bg: {$bg};
    --theme-radius: {$radius}px;
    
    /* Shades (lighter/darker variants) */
    --theme-primary-light: {$primary}20;
    --theme-primary-dark: {$primary};
    --theme-secondary-light: {$secondary}20;
}
CSS;
    }
    
    /**
     * Clear theme cache
     */
    public static function clearCache(): void
    {
        Cache::forget('theme_settings');
    }
}
