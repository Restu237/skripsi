<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice', function (Blueprint $table) {
            $table->string('kd_invoice', 9);
            $table->string('kd_so');
            $table->date('tanggal');
            $table->string('nama_kstmr', 191);
            $table->string('telepon_kstmr', 13);
            $table->string('kd_barang', 9);
            $table->string('nama_barang', 191);
            $table->double('harga_barang');
            $table->double('ppn');
            $table->double('diskon');
            $table->double('total');
            $table->double('grand_total');
            $table->timestamps();
            $table->primary('kd_invoice');

            $table->foreign('kd_so')->references('kd_so')->on('surat_jalan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoice');
    }
}
