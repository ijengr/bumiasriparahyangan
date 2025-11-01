<?php
require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

echo "🔍 Checking Unused Settings...\n\n";

// Get all setting keys from database
$settingKeys = DB::table('settings')->pluck('key')->toArray();

// Get all blade files
$bladeFiles = File::allFiles(resource_path('views'));
$allContent = '';

foreach ($bladeFiles as $file) {
    $allContent .= File::get($file->getPathname()) . "\n";
}

// Also check in controllers
$controllerFiles = File::allFiles(app_path('Http/Controllers'));
foreach ($controllerFiles as $file) {
    $allContent .= File::get($file->getPathname()) . "\n";
}

echo "📊 Total Settings in Database: " . count($settingKeys) . "\n\n";

$unused = [];
$used = [];

foreach ($settingKeys as $key) {
    // Check if key is used in blade files or controllers
    if (strpos($allContent, "'{$key}'") !== false || 
        strpos($allContent, "\"{$key}\"") !== false ||
        strpos($allContent, "['{$key}']") !== false ||
        strpos($allContent, '["' . $key . '"]') !== false ||
        preg_match("/\\\$settings\['{$key}'\]/", $allContent) ||
        preg_match("/\\\$siteSettings\['{$key}'\]/", $allContent) ||
        preg_match("/\\\$settings\[\"{$key}\"\]/", $allContent) ||
        preg_match("/\\\$siteSettings\[\"{$key}\"\]/", $allContent)) {
        $used[] = $key;
    } else {
        $unused[] = $key;
    }
}

if (!empty($unused)) {
    echo "❌ UNUSED SETTINGS (" . count($unused) . "):\n";
    echo "=" . str_repeat("=", 60) . "\n";
    foreach ($unused as $key) {
        $value = DB::table('settings')->where('key', $key)->value('value');
        $preview = strlen($value) > 50 ? substr($value, 0, 50) . '...' : $value;
        echo "   - {$key}\n";
        echo "     Value: {$preview}\n\n";
    }
} else {
    echo "✅ All settings are being used!\n";
}

echo "\n✅ USED SETTINGS (" . count($used) . "):\n";
echo "=" . str_repeat("=", 60) . "\n";
foreach ($used as $key) {
    echo "   - {$key}\n";
}

echo "\n\n📋 SUMMARY:\n";
echo "=" . str_repeat("=", 60) . "\n";
echo "Total Settings: " . count($settingKeys) . "\n";
echo "Used: " . count($used) . " ✅\n";
echo "Unused: " . count($unused) . " ❌\n";
echo "Usage Rate: " . round((count($used) / count($settingKeys)) * 100, 2) . "%\n";
