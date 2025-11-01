<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Setting;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Seed theme color settings
        $themeSettings = [
            ['key' => 'theme_primary_color', 'value' => '#059669', 'type' => 'color', 'group' => 'theme'],
            ['key' => 'theme_secondary_color', 'value' => '#0d9488', 'type' => 'color', 'group' => 'theme'],
            ['key' => 'theme_accent_color', 'value' => '#3b82f6', 'type' => 'color', 'group' => 'theme'],
            ['key' => 'theme_success_color', 'value' => '#10b981', 'type' => 'color', 'group' => 'theme'],
            ['key' => 'theme_warning_color', 'value' => '#f59e0b', 'type' => 'color', 'group' => 'theme'],
            ['key' => 'theme_danger_color', 'value' => '#ef4444', 'type' => 'color', 'group' => 'theme'],
            ['key' => 'theme_text_color', 'value' => '#111827', 'type' => 'color', 'group' => 'theme'],
            ['key' => 'theme_background_color', 'value' => '#ffffff', 'type' => 'color', 'group' => 'theme'],
            ['key' => 'theme_border_radius', 'value' => '16', 'type' => 'number', 'group' => 'theme'],
        ];

        foreach ($themeSettings as $setting) {
            Setting::firstOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Setting::whereIn('key', [
            'theme_primary_color',
            'theme_secondary_color',
            'theme_accent_color',
            'theme_success_color',
            'theme_warning_color',
            'theme_danger_color',
            'theme_text_color',
            'theme_background_color',
            'theme_border_radius',
        ])->delete();
    }
};
