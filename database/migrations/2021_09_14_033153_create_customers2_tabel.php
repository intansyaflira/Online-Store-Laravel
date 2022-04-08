<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomers2Tabel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers2_tabel', function (Blueprint $table) {
            $table->bigIncrements('id_pelanggan');
            $table->string('nama');
            $table->string('alamat');
            $table->unsignedBigInteger('telp');
            $table->string('username');
            $table->string('password');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers2_tabel');
    }
}
