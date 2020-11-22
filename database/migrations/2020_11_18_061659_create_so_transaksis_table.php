<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSoTransaksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('so_transaksi', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kd_so', 9);
            $table->string('kd_barang', 9);
            $table->string('kd_kstmr', 9);
            $table->date('tanggal');
            $table->integer('jumlah_qty');
            $table->foreign('kd_kstmr')->references('kd_kstmr')->on('customers')->onDelete('cascade');
            $table->foreign('kd_so')->references('kd_so')->on('sales_order')->onDelete('cascade');
            $table->foreign('kd_barang')->references('kd_barang')->on('barang')->onDelete('cascade');
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
        Schema::dropIfExists('so_transaksi');
    }
}
