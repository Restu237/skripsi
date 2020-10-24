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
            $table->bigIncrements('id');
            $table->string('no_so', 9)->unique();
            $table->unsignedBigInteger('kd_kstmr');
            $table->unsignedBigInteger('kd_barang');
            $table->string('nama_kstmr', 191);
            $table->string('nama_barang', 191);
            $table->string('satuan', 3);
            $table->smallInteger('qty');
            $table->string('keterangan', 50);
            $table->timestamps();

            $table->foreign('kd_kstmr')->references('id')->on('customers')->onDelete('cascade');
            $table->foreign('kd_barang')->references('id')->on('barang')->onDelete('cascade');
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
