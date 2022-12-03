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
            $table->dropColumn('deposit');
            $table->dropColumn('nama');
            $table->dropColumn('kontak');
            $table->dropColumn('waktu_kedatangan');
            $table->dropColumn('invoice_id');
            $table->dropColumn('jmlh_orang');
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
