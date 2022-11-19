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
        Schema::table('transaksi_reservasi', function(Blueprint $table){
            // $table->string('user_id');
            // $table->integer('invoice_id');
            // $table->integer('jmlh_tamu');
            // $table->double('deposit');
            // $table->text('keterangan');
            // $table->integer('status');
            // $table->softDeletes();
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
