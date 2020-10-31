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
            $table->string('kd_do');
            $table->string('kd_so');
            $table->unsignedBigInteger('id_user');
            $table->date('tanggal');
            $table->string('nama_barang', 191);
            $table->string('kd_barang', 9);
            $table->smallInteger('qty');
            $table->string('keterangan', 50);
            $table->string('penerima');
            $table->string('pengirim');
            $table->timestamps();
            $table->primary('kd_do');

            $table->foreign('kd_so')->references('kd_so')->on('sales_order')->onDelete('cascade');
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
