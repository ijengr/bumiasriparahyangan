#!/usr/bin/env php
<?php

/**
 * Database Index Analyzer
 */

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

class IndexAnalyzer
{
    private array $missingIndexes = [];
    private array $unusedIndexes = [];
    private array $recommendations = [];
    
    public function analyze(): void
    {
        echo "📊 Analyzing Database Indexes...\n";
        echo str_repeat("=", 60) . "\n\n";
        
        $this->checkImportantIndexes();
        $this->displayResults();
    }
    
    private function checkImportantIndexes(): void
    {
        $checks = [
            'units' => ['status', 'is_featured'],
            'gallery_images' => ['unit_id'],
            'facilities' => [],
            'messages' => ['is_read', 'created_at'],
            'settings' => ['group', 'key'],
        ];
        
        foreach ($checks as $table => $columns) {
            $this->analyzeTableIndexes($table, $columns);
        }
    }
    
    private function analyzeTableIndexes(string $table, array $importantColumns): void
    {
        echo "Analyzing table: $table...\n";
        
        try {
            $indexes = DB::select("SHOW INDEX FROM `{$table}`");
            $indexedColumns = collect($indexes)->pluck('Column_name')->unique()->toArray();
            
            // Check missing indexes
            foreach ($importantColumns as $column) {
                if (!in_array($column, $indexedColumns)) {
                    $this->missingIndexes[] = [
                        'table' => $table,
                        'column' => $column,
                        'reason' => 'Frequently queried column'
                    ];
                }
            }
            
            echo "  ✓ Indexed columns: " . implode(', ', $indexedColumns) . "\n";
        } catch (\Exception $e) {
            echo "  ⚠️  Error: {$e->getMessage()}\n";
        }
    }
    
    private function displayResults(): void
    {
        echo "\n" . str_repeat("=", 60) . "\n";
        echo "📊 INDEX ANALYSIS RESULTS\n";
        echo str_repeat("=", 60) . "\n\n";
        
        if (!empty($this->missingIndexes)) {
            echo "⚠️  MISSING INDEXES (" . count($this->missingIndexes) . ")\n";
            echo str_repeat("-", 60) . "\n";
            foreach ($this->missingIndexes as $item) {
                echo "  ❌ {$item['table']}.{$item['column']}\n";
                echo "     → {$item['reason']}\n";
                echo "     💡 Migration: \$table->index('{$item['column']}');\n\n";
            }
        } else {
            echo "✅ All important columns are indexed!\n\n";
        }
        
        $this->generateMigrationSuggestions();
    }
    
    private function generateMigrationSuggestions(): void
    {
        if (empty($this->missingIndexes)) {
            return;
        }
        
        echo str_repeat("=", 60) . "\n";
        echo "💾 SUGGESTED MIGRATION\n";
        echo str_repeat("=", 60) . "\n\n";
        
        echo "```php\n";
        echo "<?php\n\n";
        echo "use Illuminate\Database\Migrations\Migration;\n";
        echo "use Illuminate\Database\Schema\Blueprint;\n";
        echo "use Illuminate\Support\Facades\Schema;\n\n";
        echo "return new class extends Migration\n";
        echo "{\n";
        echo "    public function up(): void\n";
        echo "    {\n";
        
        $grouped = collect($this->missingIndexes)->groupBy('table');
        foreach ($grouped as $table => $columns) {
            echo "        Schema::table('{$table}', function (Blueprint \$table) {\n";
            foreach ($columns as $col) {
                echo "            \$table->index('{$col['column']}'); // {$col['reason']}\n";
            }
            echo "        });\n\n";
        }
        
        echo "    }\n\n";
        echo "    public function down(): void\n";
        echo "    {\n";
        
        foreach ($grouped as $table => $columns) {
            echo "        Schema::table('{$table}', function (Blueprint \$table) {\n";
            foreach ($columns as $col) {
                echo "            \$table->dropIndex(['{$col['column']}']);\n";
            }
            echo "        });\n";
        }
        
        echo "    }\n";
        echo "};\n";
        echo "```\n\n";
    }
}

// Run analyzer
$analyzer = new IndexAnalyzer();
$analyzer->analyze();
