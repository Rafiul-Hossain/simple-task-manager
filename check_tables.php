<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

echo "=== Database Tables Check ===\n\n";

// Check if database exists
try {
    $tables = DB::select("SHOW TABLES");
    
    echo "Found " . count($tables) . " tables:\n";
    foreach ($tables as $table) {
        $tableName = array_values((array)$table)[0];
        echo "- " . $tableName . "\n";
    }
    
    echo "\n=== Table Structures ===\n\n";
    
    foreach ($tables as $table) {
        $tableName = array_values((array)$table)[0];
        echo "Table: $tableName\n";
        echo str_repeat("-", strlen($tableName) + 7) . "\n";
        
        $columns = DB::select("DESCRIBE $tableName");
        foreach ($columns as $column) {
            $nullable = $column->Null === 'YES' ? "NULL" : "NOT NULL";
            $default = $column->Default ? " DEFAULT {$column->Default}" : "";
            echo "  {$column->Field} ({$column->Type}) $nullable$default\n";
        }
        echo "\n";
    }
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
} 