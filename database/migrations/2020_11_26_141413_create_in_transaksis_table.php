<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInTransaksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('in_transaksis', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kd_in', 9);
            $table->string('kd_barang', 9);
            $table->integer('qty');
            $table->double('amount');
            $table->foreign('kd_in')->references('kd_in')->on('invoices');
            $table->foreign('kd_barang')->references('kd_barang')->on('barang');
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
        Schema::dropIfExists('in_transaksis');
    }
}
