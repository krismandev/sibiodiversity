<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFamiliTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('famili', function (Blueprint $table) {
            $table->id();
            $table->string('nama_latin');
            $table->string('nama_umum')->nullable();
            $table->text('ciri_ciri')->nullable();
            $table->text('keterangan')->nullable();
            $table->integer('ordo_id');
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
        Schema::dropIfExists('famili');
    }
}
