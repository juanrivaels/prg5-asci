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
        Schema::create('sertifikats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sf_userid')->nullable()->constrained('users');
            $table->foreignId('sf_idlomba')->nullable()->constrained('lombas');
            $table->foreignId('sf_idpendaftaran')->nullable()->constrained('pendaftarans');
            $table->string('sf_juara');
            $table->string('sf_sertifikat');
            $table->dateTime('sf_tanggal');
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
        Schema::dropIfExists('sertifikats');
    }
};
