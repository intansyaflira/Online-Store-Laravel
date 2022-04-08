<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailOrder2Tabel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_order2_tabel', function (Blueprint $table) {
            $table->bigIncrements('id_detail_transaksi');
            $table->unsignedBigInteger('id_transaksi');
            $table->unsignedBigInteger('id_produk');
            $table->integer('qty');
            $table->integer('subtotal');

            $table->foreign('id_transaksi')->references('id_transaksi')->on('transaksi_tabel');
            $table->foreign('id_produk')->references('id_produk')->on('product_tabel');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_order2_tabel');
    }
}
