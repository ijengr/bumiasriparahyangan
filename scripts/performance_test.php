<?php

/**
 * Performance Testing Script
 * Run this to measure optimization improvements
 */

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use App\Models\Unit;
use App\Models\GalleryImage;
use App\Models\Facility;

echo "=== Performance Testing ===\n\n";

// Test 1: Database Query Performance
echo "1. Database Query Performance:\n";
$start = microtime(true);
$units = Unit::latest()->take(10)->get();
$queryTime = (microtime(true) - $start) * 1000;
echo "   - Query 10 units: " . number_format($queryTime, 2) . "ms\n";

// Test 2: Cache Performance
echo "\n2. Cache Performance:\n";

// First load (cache miss)
Cache::forget('homepage.units');
$start = microtime(true);
$units = Cache::remember('homepage.units', 600, function () {
    return Unit::latest()->paginate(6);
});
$cacheMissTime = (microtime(true) - $start) * 1000;
echo "   - Cache MISS: " . number_format($cacheMissTime, 2) . "ms\n";

// Second load (cache hit)
$start = microtime(true);
$units = Cache::remember('homepage.units', 600, function () {
    return Unit::latest()->paginate(6);
});
$cacheHitTime = (microtime(true) - $start) * 1000;
echo "   - Cache HIT: " . number_format($cacheHitTime, 2) . "ms\n";
echo "   - Improvement: " . number_format(($cacheMissTime - $cacheHitTime) / $cacheMissTime * 100, 1) . "%\n";

// Test 3: Index Performance
echo "\n3. Database Index Performance:\n";

// Query with type filter (should use index)
$start = microtime(true);
$units = Unit::where('type', 'Rumah')->latest()->take(10)->get();
$indexedQueryTime = (microtime(true) - $start) * 1000;
echo "   - Indexed query (type + created_at): " . number_format($indexedQueryTime, 2) . "ms\n";

// Count queries with different indexes
$start = microtime(true);
$count = Unit::count();
$countTime = (microtime(true) - $start) * 1000;
echo "   - Count query: " . number_format($countTime, 2) . "ms\n";

// Test 4: Check if indexes exist
echo "\n4. Database Indexes Check:\n";
$tables = ['units', 'gallery_images', 'facilities', 'messages', 'settings'];
foreach ($tables as $table) {
    try {
        $indexes = DB::select("SHOW INDEX FROM {$table}");
        $indexNames = array_unique(array_column($indexes, 'Key_name'));
        echo "   - {$table}: " . count($indexNames) . " indexes\n";
        foreach ($indexNames as $indexName) {
            if ($indexName !== 'PRIMARY') {
                echo "     * {$indexName}\n";
            }
        }
    } catch (\Exception $e) {
        echo "   - {$table}: Table not found\n";
    }
}

// Test 5: Memory Usage
echo "\n5. Memory Usage:\n";
$memoryUsage = memory_get_usage(true) / 1024 / 1024;
$memoryPeak = memory_get_peak_usage(true) / 1024 / 1024;
echo "   - Current: " . number_format($memoryUsage, 2) . " MB\n";
echo "   - Peak: " . number_format($memoryPeak, 2) . " MB\n";

// Test 6: WebP Support Check
echo "\n6. WebP Support:\n";
if (function_exists('imagewebp')) {
    echo "   ✓ WebP support is ENABLED\n";
} else {
    echo "   ✗ WebP support is DISABLED\n";
}

// Test 7: Cache Statistics
echo "\n7. Cache Statistics:\n";
echo "   - Driver: " . config('cache.default') . "\n";
try {
    Cache::put('test_key', 'test_value', 60);
    $value = Cache::get('test_key');
    echo "   - Cache working: " . ($value === 'test_value' ? '✓ YES' : '✗ NO') . "\n";
    Cache::forget('test_key');
} catch (\Exception $e) {
    echo "   - Cache error: " . $e->getMessage() . "\n";
}

echo "\n=== Testing Complete ===\n";
echo "\nRecommendations:\n";
echo "- Cache HIT should be 90%+ faster than MISS\n";
echo "- Indexed queries should be < 50ms\n";
echo "- WebP support should be enabled for best compression\n";
echo "- Check Network tab in browser for asset sizes\n";
