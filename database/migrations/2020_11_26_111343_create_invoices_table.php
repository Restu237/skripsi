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
        Schema::create('invoices', function (Blueprint $table) {
            $table->string('kd_in', 9);
            $table->string('kd_so', 9);
            $table->string('kd_kstmr', 9);
            $table->string('kd_do', 9);
            $table->double('ppn');
            $table->double('diskon');
            $table->double('total');
            $table->double('grand_total');
            $table->primary('kd_in');

            $table->foreign('kd_so')->references('kd_so')->on('sales_order');
            $table->foreign('kd_kstmr')->references('kd_kstmr')->on('customers');
            $table->foreign('kd_do')->references('kd_do')->on('delvery_orders');
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
        Schema::dropIfExists('invoices');
    }
}
