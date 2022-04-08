<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTabel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_tabel', function (Blueprint $table) {
            $table->bigIncrements('id_produk');
            $table->string('nama_produk');
            $table->string('deskripsi'); 
            $table->unsignedBigInteger('harga');
            $table->string('foto_produk');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_tabel');
    }
}
