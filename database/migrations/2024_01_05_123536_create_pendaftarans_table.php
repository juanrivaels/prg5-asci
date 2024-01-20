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
        Schema::create('pendaftarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pd_userid')->nullable()->constrained('users');
            $table->foreignId('pd_idlomba')->nullable()->constrained('lombas');
            $table->foreignId('pd_iddosen')->nullable()->constrained('users');
            $table->dateTime('pd_tgldaftar');
            $table->integer('pd_status');
            $table->string('pd_alasan');
            $table->string('pd_buktistatus');
            $table->dateTime('pd_tglpengajuan');
            $table->integer('pd_statuspengajuan');
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
        Schema::dropIfExists('pendaftarans');
    }
};
