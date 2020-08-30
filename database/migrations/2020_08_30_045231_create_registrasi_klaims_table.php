<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegistrasiKlaimsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registrasi_klaims', function (Blueprint $table) {
            $table->increments('id');
            $table->string('no_polis',50);
            $table->date('tgl_kejadian');
            $table->time('waktu_kejadian');
            $table->string('penyebab',255);
            $table->string('deskripsi_kejadian',255);
            $table->string('estimasi_kerugian',255);
            $table->integer('no_rek');
            $table->string('nm_bank',20);
            $table->integer('no_klaim');
            $table->integer('status');
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('registrasi_klaims');
    }
}
