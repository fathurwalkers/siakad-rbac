<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbsensisTable extends Migration
{
    public function up()
    {
        Schema::create('absensi', function (Blueprint $table) {
            $table->id();

            $table->string('absen_matapelajaran');
            $table->string('absen_status');
            $table->time('absen_waktu');
            $table->date('absen_tanggal');

            $table->unsignedBigInteger('siswa_id')->nullable();
            $table->unsignedBigInteger('matapelajaran_id')->nullable();

            $table->foreign('siswa_id')->references('id')->on('siswa')->onDelete('cascade');
            $table->foreign('matapelajaran_id')->references('id')->on('matapelajaran')->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('absensi');
    }
}
