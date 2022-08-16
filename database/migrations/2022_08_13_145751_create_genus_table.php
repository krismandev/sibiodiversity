<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('genus', function (Blueprint $table) {
            $table->id();
            $table->string('nama_latin');
            $table->string('nama_umum')->nullable();
            $table->text('ciri_ciri')->nullable();
            $table->text('keterangan')->nullable();
            $table->integer('famili_id');
            $table->date('deleted_at')->nullable();
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
        Schema::dropIfExists('genus');
    }
}
