<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiswasTable extends Migration
{
    public function up()
    {
        Schema::create('siswa', function (Blueprint $table) {
            $table->id();

            $table->string('siswa_nama')->nullable();
            $table->string('siswa_nisn')->nullable();
            $table->string('siswa_jeniskelamin')->nullable();
            $table->string('siswa_alamat')->nullable();
            $table->string('siswa_telepon')->nullable();
            $table->string('siswa_foto')->nullable();
            $table->string('siswa_status')->nullable();

            $table->unsignedBigInteger('login_id')->nullable();
            $table->unsignedBigInteger('kelas_id')->nullable();

            $table->foreign('login_id')->references('id')->on('login')->onDelete('cascade');
            $table->foreign('kelas_id')->references('id')->on('kelas')->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('siswa');
    }
}
