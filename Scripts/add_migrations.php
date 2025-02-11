<?php

$filename = $argv[1] ?? null;

if (!$filename) {
    echo "Usage: php scripts/create_migration.php CreateUsersTable\n";
    exit;
}

// Generate timestamped migration file name
$timestamp = date('YmdHis');
$migrationClass = 'm' . $timestamp . '_' . $filename;

$migrationDir = __DIR__ . "/../App/Migrations/";
if (!file_exists($migrationDir)) {
    mkdir($migrationDir, 0777, true);
}

// Check if a migration for this table already exists
$existingFiles = glob($migrationDir . "*_" . $filename . ".php");
if (!empty($existingFiles)) {
    echo "Error: A migration for '$filename' already exists:\n";
    foreach ($existingFiles as $file) {
        echo "- " . basename($file) . "\n";
    }
    echo "\nPlease use a different name or remove the existing migration first.\n";
    exit(1);
}

$migrationFile = $migrationDir . "$migrationClass.php";

// Generate migration template
$template = <<<PHP
<?php

use Illuminate\Database\Capsule\Manager as Capsule;

class $migrationClass {
    public function up() {
        Capsule::schema()->create('$filename', function (\$table) {
            \$table->increments('id');
            \$table->timestamps();
        });
    }

    public function down() {
        Capsule::schema()->dropIfExists('$filename');
    }
}
PHP;

// Create migration file
file_put_contents($migrationFile, $template);
echo "Migration created: $migrationFile\n";