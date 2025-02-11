<?php

use Illuminate\Database\Capsule\Manager as Capsule;

require_once __DIR__ . '/../bootstrap.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

// Get the max batch number and increment it
$batch = Capsule::table('migrations')->max('batch') + 1;
$migrationsDir = __DIR__ . '/../App/Migrations/';
$files = glob($migrationsDir . '/*.php');

foreach ($files as $file) {
    $migrationName = pathinfo($file, PATHINFO_FILENAME);
    $className = $migrationName;

    // Check if migration is already applied
    if (Capsule::table('migrations')->where('migration', $migrationName)->exists()) {
        echo "Skipping: $migrationName (already applied)\n";
        continue;
    }

    // Require and instantiate the class dynamically
    require_once $file;

    if (class_exists($className)) {
        try {
            $migration = new $className();
            
            // Start a transaction
            Capsule::beginTransaction();
            
            // Run the migration
            $migration->up();
            
            // Record the migration
            Capsule::table('migrations')->insert([
                'migration' => $migrationName,
                'batch' => $batch,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
            
            // Commit the transaction
            Capsule::commit();
            
            echo "Migrated: $migrationName\n";
            
        } catch (\Exception $e) {
            // Rollback the transaction if anything fails
            Capsule::rollBack();
            echo "Error migrating $migrationName: " . $e->getMessage() . "\n";
        }
    } else {
        echo "Error: Class $className not found\n";
    }
}