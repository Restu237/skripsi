<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_order', function (Blueprint $table) {
            $table->string('kd_so', 9);
            $table->string('kd_kstmr');
            $table->string('kd_barang');
            $table->string('nama_kstmr', 191);
            $table->string('nama_barang', 191);
            $table->string('satuan', 3);
            $table->smallInteger('qty');
            $table->string('keterangan', 50);
            $table->timestamps();
            $table->primary('kd_so');

            $table->foreign('kd_kstmr')->references('kd_kstmr')->on('customers')->onDelete('cascade');
            $table->foreign('kd_barang')->references('kd_barang')->on('barang')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales_orders');
    }
}
