<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuratJalansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surat_jalan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('no_so');
            $table->string('kd_do', 9);
            $table->date('tanggal');
            $table->string('nama_barang', 191);
            $table->string('kd_barang', 9);
            $table->smallInteger('qty');
            $table->string('keterangan', 50);
            $table->string('penerima');
            $table->unsignedBigInteger('id_user');
            $table->string('pengirim');
            $table->timestamps();
            $table->foreign('no_so')->references('id')->on('sales_order')->onDelete('cascade');
            $table->foreign('id_user')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('surat_jalan');
    }
}
