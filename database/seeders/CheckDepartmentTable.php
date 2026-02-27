<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CheckDepartmentTable extends Seeder
{
    public function run(): void
    {
        echo "\n=== CHECK DEPARTMENT TABLE ===\n\n";
        
        // Get all tables
        $tables = DB::select('SHOW TABLES');
        $dbName = env('DB_DATABASE');
        $tableKey = "Tables_in_{$dbName}";
        
        echo "Looking for department-related tables:\n\n";
        
        foreach ($tables as $table) {
            $tableName = $table->$tableKey;
            if (stripos($tableName, 'depart') !== false || stripos($tableName, 'dept') !== false) {
                echo "✓ Found: {$tableName}\n";
                
                // Show columns
                $columns = DB::select("SHOW COLUMNS FROM {$tableName}");
                echo "  Columns: ";
                $colNames = array_map(fn($c) => $c->Field, $columns);
                echo implode(', ', $colNames) . "\n\n";
            }
        }
        
        // Also check for mst_ tables
        echo "\nAll mst_ tables:\n";
        foreach ($tables as $table) {
            $tableName = $table->$tableKey;
            if (stripos($tableName, 'mst_') === 0) {
                echo "- {$tableName}\n";
            }
        }
    }
}
