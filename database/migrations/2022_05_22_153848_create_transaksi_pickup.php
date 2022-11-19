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
        Schema::create('transaksi_pickup', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->double('langitude')->nullable();
            $table->double('latitude')->nullable();
            $table->integer('invoice_id');
            $table->text('keterangan');
            $table->integer('status');
            $table->softDeletes();
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
        Schema::dropIfExists('transaksi_pickup');
    }
};
