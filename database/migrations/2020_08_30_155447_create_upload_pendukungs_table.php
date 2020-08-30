<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUploadPendukungsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('upload_pendukungs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('reg_id');
            $table->string('lokasi_file',100);
            $table->date('tgl_upload');
            $table->string('name_file',255);
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
        Schema::dropIfExists('upload_pendukungs');
    }
}
