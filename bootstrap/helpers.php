<?php

use App\Helpers\ThemeHelper;

if (!function_exists('theme')) {
    /**
     * Get theme setting value
     */
    function theme(string $key, string $default = ''): string
    {
        $map = [
            'primary' => 'theme_primary_color',
            'secondary' => 'theme_secondary_color',
            'accent' => 'theme_accent_color',
            'success' => 'theme_success_color',
            'warning' => 'theme_warning_color',
            'danger' => 'theme_danger_color',
            'text' => 'theme_text_color',
            'background' => 'theme_background_color',
            'radius' => 'theme_border_radius',
        ];
        
        $defaults = [
            'primary' => '#059669',
            'secondary' => '#0d9488',
            'accent' => '#3b82f6',
            'success' => '#10b981',
            'warning' => '#f59e0b',
            'danger' => '#ef4444',
            'text' => '#1f2937',
            'background' => '#ffffff',
            'radius' => '16',
        ];
        
        $fullKey = $map[$key] ?? $key;
        $defaultValue = $default ?: ($defaults[$key] ?? '');
        
        return ThemeHelper::getThemeValue($fullKey, $defaultValue);
    }
}
