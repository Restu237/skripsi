<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDoTransaksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('do_transaksi', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kd_do', 9);
            $table->string('kd_barang', 9);
            $table->integer('qty');
            $table->timestamps();
            $table->foreign('kd_do')->references('kd_do')->on('delvery_orders');
            $table->foreign('kd_barang')->references('kd_barang')->on('barang');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('do_transaksi');
    }
}
