#!/usr/bin/env php
<?php

/**
 * Database Analyzer - Find Unused/Empty Tables and Optimize Database
 */

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DatabaseAnalyzer
{
    private array $emptyTables = [];
    private array $lowDataTables = [];
    private array $activeTables = [];
    private array $unusedColumns = [];
    
    public function analyze(): void
    {
        echo "🔍 Analyzing Database...\n";
        echo str_repeat("=", 60) . "\n\n";
        
        $tables = $this->getAllTables();
        
        foreach ($tables as $table) {
            $this->analyzeTable($table);
        }
        
        $this->displayResults();
        $this->generateOptimizationScript();
    }
    
    private function getAllTables(): array
    {
        $database = config('database.connections.mysql.database');
        $results = DB::select("SHOW TABLES");
        $key = "Tables_in_{$database}";
        
        return array_map(fn($r) => $r->$key, $results);
    }
    
    private function analyzeTable(string $table): void
    {
        echo "📊 Analyzing table: {$table}...\n";
        
        // Get row count
        $count = DB::table($table)->count();
        
        // Get table size
        $size = $this->getTableSize($table);
        
        if ($count === 0) {
            $this->emptyTables[] = [
                'table' => $table,
                'size' => $size,
                'reason' => 'No records'
            ];
        } elseif ($count < 5 && !in_array($table, ['users', 'migrations', 'settings'])) {
            $this->lowDataTables[] = [
                'table' => $table,
                'count' => $count,
                'size' => $size,
                'reason' => 'Very low data (< 5 records)'
            ];
        } else {
            $this->activeTables[] = [
                'table' => $table,
                'count' => $count,
                'size' => $size
            ];
        }
        
        // Analyze columns
        if ($count > 0) {
            $this->analyzeColumns($table);
        }
    }
    
    private function getTableSize(string $table): string
    {
        try {
            $database = config('database.connections.mysql.database');
            $result = DB::selectOne("
                SELECT 
                    ROUND(((data_length + index_length) / 1024 / 1024), 2) AS size_mb
                FROM information_schema.TABLES 
                WHERE table_schema = ? AND table_name = ?
            ", [$database, $table]);
            
            return $result ? $result->size_mb . ' MB' : 'N/A';
        } catch (\Exception $e) {
            return 'N/A';
        }
    }
    
    private function analyzeColumns(string $table): void
    {
        try {
            $columns = Schema::getColumnListing($table);
            $sample = DB::table($table)->limit(100)->get();
            
            foreach ($columns as $column) {
                // Skip system columns
                if (in_array($column, ['id', 'created_at', 'updated_at', 'deleted_at'])) {
                    continue;
                }
                
                // Check if column is always null
                $nullCount = $sample->whereNull($column)->count();
                
                if ($nullCount === $sample->count()) {
                    $this->unusedColumns[] = [
                        'table' => $table,
                        'column' => $column,
                        'reason' => 'Always NULL in 100 samples'
                    ];
                }
            }
        } catch (\Exception $e) {
            // Skip if error
        }
    }
    
    private function displayResults(): void
    {
        echo "\n" . str_repeat("=", 60) . "\n";
        echo "📊 DATABASE ANALYSIS RESULTS\n";
        echo str_repeat("=", 60) . "\n\n";
        
        // Empty tables
        if (!empty($this->emptyTables)) {
            echo "⚠️  EMPTY TABLES (" . count($this->emptyTables) . ")\n";
            echo str_repeat("-", 60) . "\n";
            foreach ($this->emptyTables as $item) {
                echo "  ❌ {$item['table']} - {$item['size']}\n";
                echo "     → {$item['reason']}\n\n";
            }
        }
        
        // Low data tables
        if (!empty($this->lowDataTables)) {
            echo "⚠️  LOW DATA TABLES (" . count($this->lowDataTables) . ")\n";
            echo str_repeat("-", 60) . "\n";
            foreach ($this->lowDataTables as $item) {
                echo "  ⚠️  {$item['table']} - {$item['count']} records - {$item['size']}\n";
                echo "     → {$item['reason']}\n\n";
            }
        }
        
        // Unused columns
        if (!empty($this->unusedColumns)) {
            echo "⚠️  POTENTIALLY UNUSED COLUMNS (" . count($this->unusedColumns) . ")\n";
            echo str_repeat("-", 60) . "\n";
            $grouped = collect($this->unusedColumns)->groupBy('table');
            foreach ($grouped as $table => $columns) {
                echo "  📋 {$table}:\n";
                foreach ($columns as $col) {
                    echo "     - {$col['column']} ({$col['reason']})\n";
                }
                echo "\n";
            }
        }
        
        // Active tables
        if (!empty($this->activeTables)) {
            echo "✅ ACTIVE TABLES (" . count($this->activeTables) . ")\n";
            echo str_repeat("-", 60) . "\n";
            
            // Sort by count descending
            usort($this->activeTables, fn($a, $b) => $b['count'] <=> $a['count']);
            
            foreach ($this->activeTables as $item) {
                echo sprintf("  ✓ %-30s %6d records  %8s\n", 
                    $item['table'], 
                    $item['count'], 
                    $item['size']
                );
            }
            echo "\n";
        }
        
        // Summary
        echo str_repeat("=", 60) . "\n";
        echo "📈 SUMMARY\n";
        echo str_repeat("=", 60) . "\n";
        echo "Empty tables:          " . count($this->emptyTables) . "\n";
        echo "Low data tables:       " . count($this->lowDataTables) . "\n";
        echo "Active tables:         " . count($this->activeTables) . "\n";
        echo "Unused columns found:  " . count($this->unusedColumns) . "\n";
        echo "\n";
        
        // Recommendations
        $this->displayRecommendations();
    }
    
    private function displayRecommendations(): void
    {
        echo str_repeat("=", 60) . "\n";
        echo "💡 RECOMMENDATIONS\n";
        echo str_repeat("=", 60) . "\n\n";
        
        if (empty($this->emptyTables) && empty($this->lowDataTables) && empty($this->unusedColumns)) {
            echo "✅ Database looks healthy! No optimization needed.\n\n";
            return;
        }
        
        if (!empty($this->emptyTables)) {
            echo "1. Empty Tables:\n";
            foreach ($this->emptyTables as $item) {
                if (in_array($item['table'], ['cache', 'cache_locks', 'jobs', 'job_batches', 'failed_jobs', 'sessions'])) {
                    echo "   ✓ {$item['table']} - Normal for Laravel system table\n";
                } else {
                    echo "   ⚠️  {$item['table']} - Consider if still needed\n";
                }
            }
            echo "\n";
        }
        
        if (!empty($this->lowDataTables)) {
            echo "2. Low Data Tables:\n";
            echo "   → Seed more data for testing or normal for production\n\n";
        }
        
        if (!empty($this->unusedColumns)) {
            echo "3. Unused Columns:\n";
            echo "   → Review if these columns are still needed\n";
            echo "   → Consider removing unused columns in migration\n\n";
        }
        
        echo "4. Database Optimization:\n";
        echo "   → Run OPTIMIZE TABLE to reclaim space\n";
        echo "   → Consider adding indexes on frequently queried columns\n\n";
    }
    
    private function generateOptimizationScript(): void
    {
        if (empty($this->activeTables)) {
            return;
        }
        
        $sql = "-- Database Optimization Script\n";
        $sql .= "-- Generated on: " . date('Y-m-d H:i:s') . "\n\n";
        
        $sql .= "-- Optimize all tables\n";
        foreach ($this->activeTables as $item) {
            $sql .= "OPTIMIZE TABLE `{$item['table']}`;\n";
        }
        
        $sql .= "\n-- Analyze tables for better query optimization\n";
        foreach ($this->activeTables as $item) {
            $sql .= "ANALYZE TABLE `{$item['table']}`;\n";
        }
        
        file_put_contents(__DIR__ . '/optimize_database.sql', $sql);
        
        echo "💾 Optimization SQL generated: scripts/optimize_database.sql\n\n";
    }
}

// Run analyzer
$analyzer = new DatabaseAnalyzer();
$analyzer->analyze();
