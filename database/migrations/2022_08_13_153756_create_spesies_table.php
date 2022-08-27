<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpesiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spesies', function (Blueprint $table) {
            $table->id();
            $table->string('nama_latin');
            $table->string('nama_umum');
            $table->integer('genus_id');
            $table->string('meristik')->nullable();
            $table->integer('status_konservasi_id')->nullable();
            $table->string('potensi')->nullable();
            $table->string('keaslian_jenis')->nullable();
            $table->text('distribusi_global')->nullable();
            $table->text('deskripsi')->nullable();
            $table->string('rujukan')->nullable();
            $table->string('gambar')->nullable();
            $table->boolean('is_approved')->nullable();
            $table->integer('user_id');
            $table->string('status')->nullable();
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
        Schema::dropIfExists('spesies');
    }
}
