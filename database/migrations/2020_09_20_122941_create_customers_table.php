<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->integer('id');
            $table->string('kd_kstmr', 4);
            // CS0001
            $table->string('nama');
            $table->string('telepon', 13);
            $table->text('alamat', 225);
            $table->timestamps();

            $table->primary(['id', 'kd_kstmr']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
