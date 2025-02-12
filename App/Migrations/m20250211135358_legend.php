<?php

use Illuminate\Database\Capsule\Manager as Capsule;

class m20250211135358_legend {
    public function up() {
        Capsule::schema()->create('legend', function ($table) {
            $table->increments('id');
            $table->timestamps();
        });
    }

    public function down() {
        Capsule::schema()->dropIfExists('legend');
    }
}