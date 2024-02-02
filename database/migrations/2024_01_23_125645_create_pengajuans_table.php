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
        Schema::create('pengajuans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pn_userid')->nullable()->constrained('users');
            $table->foreignId('pn_idlomba')->nullable()->constrained('lombas');
            $table->foreignId('pn_iddosen')->nullable()->constrained('users');
            $table->foreignId('pn_idpendaftaran')->nullable()->constrained('pendaftarans');
            $table->string('pn_revisimahasiswa');
            $table->string('pn_alasantolak');
            $table->string('pn_revisidosen');
            $table->dateTime('pn_tglpengajuan');
            $table->integer('pn_status');
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
        Schema::dropIfExists('pengajuans');
    }
};
