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
            $table->string('kd_kstmr', 9)->unique();
            // CS0001
            $table->string('nama_perusahaan');
            $table->string('telepon', 13);
            $table->text('alamat');
            $table->string('contact_person');
            $table->string('handphone', 13);
            $table->timestamps();
            $table->primary('kd_kstmr');
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
