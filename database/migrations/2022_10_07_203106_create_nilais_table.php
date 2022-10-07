<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNilaisTable extends Migration
{
    public function up()
    {
        Schema::create('nilai', function (Blueprint $table) {
            $table->id();

            $table->string('nilai_siswa_tugas')->nullable();
            $table->string('nilai_siswa_absensi')->nullable();
            $table->string('nilai_siswa_uts')->nullable();
            $table->string('nilai_siswa_uas')->nullable();
            $table->string('nilai_ratarata')->nullable();
            $table->time('nilai_waktu');
            $table->date('nilai_tanggal');

            $table->unsignedBigInteger('matapelajaran_id')->nullable();
            $table->unsignedBigInteger('guru_id')->nullable();
            $table->unsignedBigInteger('siswa_id')->nullable();

            $table->foreign('matapelajaran_id')->references('id')->on('matapelajaran');
            $table->foreign('guru_id')->references('id')->on('guru');
            $table->foreign('siswa_id')->references('id')->on('siswa');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('nilai');
    }
}
