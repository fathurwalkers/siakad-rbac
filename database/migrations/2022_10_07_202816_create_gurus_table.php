<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGurusTable extends Migration
{
    public function up()
    {
        Schema::create('guru', function (Blueprint $table) {
            $table->id();

            $table->string('guru_nama')->nullable();
            $table->string('guru_nip')->nullable();
            $table->string('guru_jeniskelamin')->nullable();
            $table->string('guru_alamat')->nullable();
            $table->string('guru_telepon')->nullable();
            $table->string('guru_foto')->nullable();
            $table->string('guru_status')->nullable();
            $table->string('guru_kode');

            $table->unsignedBigInteger('login_id')->nullable();
            $table->unsignedBigInteger('semester_id')->nullable();
            $table->unsignedBigInteger('kelas_id')->nullable();
            $table->unsignedBigInteger('matapelajaran_id')->nullable();

            $table->foreign('login_id')->references('id')->on('login');
            $table->foreign('semester_id')->references('id')->on('semester');
            $table->foreign('kelas_id')->references('id')->on('kelas');
            $table->foreign('matapelajaran_id')->references('id')->on('matapelajaran');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('guru');
    }
}
