<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailSpesimenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_spesimen', function (Blueprint $table) {
            $table->id();
            $table->integer('spesies_id');
            $table->string('kd_spesimen');
            $table->integer('lokasi_penemuan_id')->nullable();
            $table->text('kolektor')->nullable();
            $table->text('lokasi_penyimpanan')->nullable();
            $table->string('rantai_dna')->nullable();
            $table->date('tanggal_penemuan')->nullable();
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
        Schema::dropIfExists('detail_spesimen');
    }
}
