<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWisatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wisatas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama');
            $table->text('alamat');
            $table->string('no_telp');
            $table->text('keterangan');
            $table->string('lat');
            $table->string('long');
            $table->string('foto');
            $table->integer('id_user')->unsigned();
            $table->integer('id_kategori')->unsigned();
            $table->timestamps();

            $table->foreign('id_user')->references('id')->on('users')
            ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_kategori')->references('id')->on('categories')
            ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wisatas');
    }
}
