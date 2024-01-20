<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('us_nama');
            $table->string('us_noinduk');
            $table->string('us_role');
            $table->string('us_email');
            $table->string('us_telepon');
            $table->string('us_username');
            $table->string('us_password');
            $table->string('us_pasfoto');
            $table->integer('us_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
