#!/usr/bin/env php
<?php

/**
 * Database Cleanup & Optimization Script
 */

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

class DatabaseCleaner
{
    private int $cleaned = 0;
    private float $spaceSaved = 0;
    
    public function clean(): void
    {
        echo "🧹 Database Cleanup & Optimization\n";
        echo str_repeat("=", 60) . "\n\n";
        
        $this->cleanOldSessions();
        $this->cleanExpiredCache();
        $this->cleanOldMessages();
        $this->optimizeTables();
        
        $this->displaySummary();
    }
    
    private function cleanOldSessions(): void
    {
        echo "🗑️  Cleaning old sessions...\n";
        
        // Delete sessions older than 30 days
        $thirtyDaysAgo = now()->subDays(30)->timestamp;
        $count = DB::table('sessions')
            ->where('last_activity', '<', $thirtyDaysAgo)
            ->count();
        
        if ($count > 0) {
            DB::table('sessions')
                ->where('last_activity', '<', $thirtyDaysAgo)
                ->delete();
            
            echo "   ✓ Deleted $count old sessions (>30 days)\n";
            $this->cleaned += $count;
        } else {
            echo "   ✓ No old sessions to clean\n";
        }
        echo "\n";
    }
    
    private function cleanExpiredCache(): void
    {
        echo "🗑️  Cleaning expired cache...\n";
        
        $now = time();
        $count = DB::table('cache')
            ->where('expiration', '<', $now)
            ->count();
        
        if ($count > 0) {
            DB::table('cache')
                ->where('expiration', '<', $now)
                ->delete();
            
            echo "   ✓ Deleted $count expired cache entries\n";
            $this->cleaned += $count;
        } else {
            echo "   ✓ No expired cache to clean\n";
        }
        echo "\n";
    }
    
    private function cleanOldMessages(): void
    {
        echo "🗑️  Checking old messages...\n";
        
        // Count messages older than 90 days
        $ninetyDaysAgo = now()->subDays(90);
        $count = DB::table('messages')
            ->where('created_at', '<', $ninetyDaysAgo)
            ->count();
        
        if ($count > 0) {
            echo "   ⚠️  Found $count messages older than 90 days\n";
            echo "   💡 Consider archiving or deleting old messages\n";
            echo "   → To delete: DB::table('messages')->where('created_at', '<', now()->subDays(90))->delete();\n";
        } else {
            echo "   ✓ No old messages to clean\n";
        }
        echo "\n";
    }
    
    private function optimizeTables(): void
    {
        echo "⚙️  Optimizing database tables...\n";
        
        $tables = [
            'sessions',
            'settings',
            'gallery_images',
            'units',
            'messages',
            'facilities',
            'users',
            'cache'
        ];
        
        foreach ($tables as $table) {
            try {
                $sizeBefore = $this->getTableSize($table);
                
                DB::statement("OPTIMIZE TABLE `{$table}`");
                DB::statement("ANALYZE TABLE `{$table}`");
                
                $sizeAfter = $this->getTableSize($table);
                $saved = $sizeBefore - $sizeAfter;
                
                echo "   ✓ Optimized: {$table}";
                if ($saved > 0) {
                    echo " (saved " . number_format($saved, 2) . " MB)";
                    $this->spaceSaved += $saved;
                }
                echo "\n";
            } catch (\Exception $e) {
                echo "   ⚠️  {$table}: {$e->getMessage()}\n";
            }
        }
        echo "\n";
    }
    
    private function getTableSize(string $table): float
    {
        try {
            $database = config('database.connections.mysql.database');
            $result = DB::selectOne("
                SELECT 
                    ROUND(((data_length + index_length) / 1024 / 1024), 2) AS size_mb
                FROM information_schema.TABLES 
                WHERE table_schema = ? AND table_name = ?
            ", [$database, $table]);
            
            return $result ? (float)$result->size_mb : 0;
        } catch (\Exception $e) {
            return 0;
        }
    }
    
    private function displaySummary(): void
    {
        echo str_repeat("=", 60) . "\n";
        echo "✅ CLEANUP COMPLETED\n";
        echo str_repeat("=", 60) . "\n";
        echo "Records cleaned:     {$this->cleaned}\n";
        echo "Space optimized:     " . number_format($this->spaceSaved, 2) . " MB\n";
        echo "\n";
        
        // Display current database size
        $this->displayDatabaseSize();
        
        // Recommendations
        echo "\n";
        echo "💡 RECOMMENDATIONS:\n";
        echo str_repeat("-", 60) . "\n";
        echo "1. Schedule regular cleanups:\n";
        echo "   → Add to cron: php artisan schedule:run\n";
        echo "   → In Kernel.php: \$schedule->command('cache:prune-stale-tags')->hourly();\n\n";
        
        echo "2. Monitor database size:\n";
        echo "   → Run this script monthly\n";
        echo "   → Check slow queries with: php artisan db:monitor\n\n";
        
        echo "3. Backup before major cleanup:\n";
        echo "   → mysqldump -u user -p database > backup.sql\n\n";
    }
    
    private function displayDatabaseSize(): void
    {
        try {
            $database = config('database.connections.mysql.database');
            $result = DB::selectOne("
                SELECT 
                    ROUND(SUM(data_length + index_length) / 1024 / 1024, 2) AS size_mb,
                    COUNT(*) as table_count
                FROM information_schema.TABLES 
                WHERE table_schema = ?
            ", [$database]);
            
            if ($result) {
                echo "📊 DATABASE INFO:\n";
                echo str_repeat("-", 60) . "\n";
                echo "Total size:          {$result->size_mb} MB\n";
                echo "Total tables:        {$result->table_count}\n";
            }
        } catch (\Exception $e) {
            // Skip if can't get size
        }
    }
}

// Run cleaner
$cleaner = new DatabaseCleaner();
$cleaner->clean();
