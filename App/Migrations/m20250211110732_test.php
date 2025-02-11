<?php

use Illuminate\Database\Capsule\Manager as Capsule;

class m20250211110732_test {
    public function up() {
        Capsule::schema()->create('test', function ($table) {
            $table->increments('id');
            $table->timestamps();
        });
    }

    public function down() {
        Capsule::schema()->dropIfExists('test');
    }
}