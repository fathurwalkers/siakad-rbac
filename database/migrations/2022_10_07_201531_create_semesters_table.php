<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSemestersTable extends Migration
{
    public function up()
    {
        Schema::create('semester', function (Blueprint $table) {
            $table->id();

            $table->string('semester_kode')->nullable();
            $table->string('semester_status')->nullable();
            $table->string('semester_tahunajaran')->nullable();
            $table->string('semester_nipkepsek')->nullable();

            $table->unsignedBigInteger('guru_id')->nullable();
            $table->foreign('guru_id')->references('id')->on('guru');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('semester');
    }
}
