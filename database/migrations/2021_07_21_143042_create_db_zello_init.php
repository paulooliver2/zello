<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDbZelloInit extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('person', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->date('birthdate');
            $table->string('cpf');
            $table->string('rg');
            $table->integer('profile');
        });
        Schema::create('apps', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('bundle_id');
        });
        Schema::create('person_apps', function (Blueprint $table) {
            $table->id();
            $table->foreignId('person_id');
            $table->foreignId('apps_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('db_zello');
    }
}
