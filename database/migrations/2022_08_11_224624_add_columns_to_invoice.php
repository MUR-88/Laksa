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
        Schema::table('invoice', function (Blueprint $table) {
        $table->foreignId('user_alamat_id')->nullable();
        $table->integer('ongkir')->nullable();
        $table->string('langitude')->nullable();
        $table->string('latitude')->nullable();
        $table->string('catatan')->nullable();
        $table->foreignId('driver_id')->nullable();
        $table->integer('ongkir_driver')->nullable();
        $table->foreignId('voucher_id')->nullable();
        $table->integer('potongan')->nullable();
        $table->integer('total')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('invoice', function (Blueprint $table) {
            //
        });
    }
};
