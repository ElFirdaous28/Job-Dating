<?php

use Illuminate\Database\Capsule\Manager as Capsule;

require_once __DIR__ . '/../bootstrap.php';  // Ensure bootstrap is loaded for Capsule setup
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

// Get the latest batch number
$batch = Capsule::table('migrations')->max('batch');

if (!$batch) {
    echo "No migrations to rollback.\n";
    exit;
}

$migrations = Capsule::table('migrations')->where('batch', $batch)->get();

foreach ($migrations as $migration) {
    $file = __DIR__ . "/../App/Migrations/{$migration->migration}.php";

    
    if (file_exists($file)) {
    
        require_once $file;
        $className = pathinfo($file, PATHINFO_FILENAME);
        
        if (class_exists($className)) {
            $instance = new $className();
            $instance->down();

            // Remove migration record from database
            Capsule::table('migrations')->where('migration', $migration->migration)->delete();

            echo "Rolled back: {$migration->migration}\n";
        }
    }
}
