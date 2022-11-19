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
        Schema::create('invoice', function (Blueprint $table) {
            $table->id();
            $table->string('kode');
            $table->integer('status')->comment('selesai atau belum');
            $table->string('status_pembayaran');
            $table->string('status_ordered')->comment('pickup atau tidak');
            $table->string('tujuan_alamat')->comment('alamat jika delivery');
            $table->timestamp('waktu_order');
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
        Schema::dropIfExists('invoice');
    }
};
