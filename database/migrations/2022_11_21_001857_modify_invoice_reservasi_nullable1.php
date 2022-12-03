<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('invoice_reservasi', function (Blueprint $table) {
            $table->string('nama')->nullable();
            $table->double('deposit')->nullable();
            $table->string('kontak')->nullable();
            $table->string('waktu_kedatangan')->nullable();
            $table->string('invoice_id')->nullable();
            $table->string('jmlh_orang')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
