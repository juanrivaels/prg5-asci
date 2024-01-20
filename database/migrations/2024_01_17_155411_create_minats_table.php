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
        Schema::create('minats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mn_iduser')->nullable()->constrained('users');
            $table->foreignId('mn_idtopik')->nullable()->constrained('topiks');
            $table->string('mn_minat');
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
        Schema::dropIfExists('minats');
    }
};
