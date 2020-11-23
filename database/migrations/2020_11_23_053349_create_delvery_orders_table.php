<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDelveryOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delvery_orders', function (Blueprint $table) {
            $table->string('kd_do', 9);
            $table->string('kd_so', 9);
            $table->string('kd_kstmr', 9);
            $table->unsignedBigInteger('user_id');
            $table->date('tanggal');
            $table->text('keterangan');
            $table->integer('total_qty');
            $table->timestamps();
            $table->primary('kd_do');

            // deklare foreign key
            $table->foreign('kd_so')->references('kd_so')->on('sales_order');
            $table->foreign('kd_kstmr')->references('kd_kstmr')->on('customers');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('delvery_orders');
    }
}
