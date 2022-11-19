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
        Schema::create('voucher', function(Blueprint $table){
            $table->id();
            $table->string('user_id')->nullable();
            $table->string('nama');
            $table->string('foto')->default('images/voucher/default.png');
            $table->text('deskripsi');
            $table->double('potongan_harga')->nullable();
            $table->double('potongan_persen')->nullable();
            $table->integer('min_item')->nullable()->comment('minimal beli item nya');
            $table->integer('min_beli')->nullable()->comment('minimal beli duit nya');
            $table->double('max_potongan')->nullable()->comment('maximal diskon duit nya');
            $table->integer('expired_time')->comment('batas aktif dalam menit');

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
        Schema::dropIfExists('voucher');
    }
};
