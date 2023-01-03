<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataSpksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_spks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama_brg', 100)->nullable();
            $table->string('bahan', 100)->nullable();
            $table->integer('ukuranP')->nullable();
            $table->integer('ukuranL')->nullable();
            $table->string('uk_alias')->nullable();
            $table->integer('qty')->nullable();
            $table->boolean('fns')->nullable()->default(true);
            $table->boolean('ls')->nullable()->default(false);
            $table->string('kategori')->nullable();
            $table->string('keterangan')->nullable();
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
        Schema::dropIfExists('data_spks');
    }
}
