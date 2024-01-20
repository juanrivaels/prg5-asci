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
        Schema::create('lombas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lb_iduser')->nullable()->constrained('users');
            $table->foreignId('lb_idtopik')->nullable()->constrained('topiks');
            $table->string('lb_judul');
            $table->dateTime('lb_tglmulai');
            $table->dateTime('lb_tglselesai');
            $table->integer('lb_kategori');
            $table->integer('lb_jenis');
            $table->integer('lb_tingkat');
            $table->integer('lb_status');
            $table->string('lb_penyelenggara');
            $table->integer('lb_pelaksanaan');
            $table->string('lb_lokasi');
            $table->string('lb_deskripsi');
            $table->string('lb_gambar');
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
        Schema::dropIfExists('lombas');
    }
};
