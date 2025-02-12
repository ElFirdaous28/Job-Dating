<?php

use Illuminate\Database\Capsule\Manager as Capsule;

class m20250212105723_companies {
    public function up() {
        Capsule::schema()->create('companies', function ($table) {
            $table->increments('id');
            $table->string('company_name', 255);
            $table->text('description')->nullable();
            $table->string('email', 255)->unique();
            $table->string('phone', 20)->nullable();
            $table->string('website', 255)->nullable();
            $table->timestamps();
        });
    }

    public function down() {
        Capsule::schema()->dropIfExists('companies');
    }
}