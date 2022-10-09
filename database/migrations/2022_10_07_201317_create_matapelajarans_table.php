<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatapelajaransTable extends Migration
{
    public function up()
    {
        Schema::create('matapelajaran', function (Blueprint $table) {
            $table->id();
            $table->string('matapelajaran_nama')->nullable();
            $table->string('matapelajaran_kode')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('matapelajaran');
    }
}
