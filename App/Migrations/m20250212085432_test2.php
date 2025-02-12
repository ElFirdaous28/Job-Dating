<?php

use Illuminate\Database\Capsule\Manager as Capsule;

class m20250212085432_test2 {
    public function up() {
        Capsule::schema()->create('test2', function ($table) {
            $table->increments('id');
            $table->timestamps();
        });
    }

    public function down() {
        Capsule::schema()->dropIfExists('test2');
    }
}