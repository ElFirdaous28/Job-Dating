<?php

use Illuminate\Database\Capsule\Manager as Capsule;

require_once '../vendor/autoload.php';
require_once 'config/config.php';
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