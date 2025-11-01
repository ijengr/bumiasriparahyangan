<?php
require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

echo "🗑️  Cleaning Up Unused Settings...\n\n";

// List of unused settings to delete
$unusedSettings = [
    'about_badge_subtitle',
    'about_badge_title',
    'about_section_badge',
    'about_section_title',
    'about_stat1_label',
    'about_stat1_value',
    'about_stat2_label',
    'about_stat2_value',
    'about_stat3_label',
    'about_stat3_value',
    'about_values_badge',
    'about_values_subtitle',
    'about_values_title',
    'community_description',
    'community_families_count',
    'community_stat',
    'community_title',
    'cta_button_text',
    'facilities_cta_badge',
    'facilities_cta_button1_text',
    'facilities_cta_button2_text',
    'featured_units_subtitle',
    'featured_units_title',
    'gallery_hero_subtitle',
    'units_hero_subtitle',
    'units_stat1_label',
    'units_stat1_value',
    'units_stat2_label',
    'units_stat2_value',
    'units_stat3_label',
    'units_stat3_value',
];

echo "📋 Settings to be deleted: " . count($unusedSettings) . "\n\n";

// Show what will be deleted
foreach ($unusedSettings as $key) {
    $setting = DB::table('settings')->where('key', $key)->first();
    if ($setting) {
        $preview = strlen($setting->value) > 50 ? substr($setting->value, 0, 50) . '...' : $setting->value;
        echo "   - {$key}\n";
        echo "     Value: {$preview}\n\n";
    }
}

echo "\n⚠️  WARNING: This will permanently delete these settings!\n";
echo "Do you want to continue? (yes/no): ";

$handle = fopen("php://stdin", "r");
$line = trim(fgets($handle));

if (strtolower($line) === 'yes' || strtolower($line) === 'y') {
    echo "\n🔄 Deleting unused settings...\n\n";
    
    $deleted = DB::table('settings')->whereIn('key', $unusedSettings)->delete();
    
    echo "✅ Successfully deleted {$deleted} unused settings!\n\n";
    
    // Verify
    $remaining = DB::table('settings')->count();
    echo "📊 Remaining settings in database: {$remaining}\n";
    
    // Clear cache
    echo "\n🧹 Clearing cache...\n";
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    
    echo "✅ Cache cleared!\n";
    echo "\n🎉 Cleanup completed successfully!\n";
} else {
    echo "\n❌ Cleanup cancelled. No settings were deleted.\n";
}

fclose($handle);
