<?php

use Illuminate\Database\Capsule\Manager as Capsule;

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/config/config.php';
$capsule = new Capsule;

$capsule->addConnection([
   'driver'    => 'mysql',
   'host'      => DB_HOST,
   'database'  => DB_NAME,
   'username'  => DB_USER,
   'password'  => DB_PASSWORD,
]);

$capsule->setAsGlobal();
$capsule->bootEloquent();

// Create migrations table if not exists
if (!Capsule::schema()->hasTable('migrations')) {
   Capsule::schema()->create('migrations', function ($table) {
      $table->increments('id');
      $table->string('migration');
      $table->integer('batch');
      $table->timestamps();
   });
}
