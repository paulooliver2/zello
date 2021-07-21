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
            $table->date('birthdate_at');
            $table->string('cpf');
            $table->string('rg');
            $table->integer('profile');
        });
        Schema::create('app', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->date('bundle_id');
        });
        Schema::create('tb_person_app', function (Blueprint $table) {
            $table->id();
            $table->foreignId('person_id');
            $table->foreignId('app_id');
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
