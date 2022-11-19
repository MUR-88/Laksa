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
        Schema::create('push_notification', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable();
            $table->foreignId('invoice_id')->nullable();
            $table->string('judul');
            $table->string('isi');
            $table->string('foto')->nullable();
            $table->boolean('is_admin')->default(0);
            $table->timestamp('scheduled_at')->nullable();
            $table->boolean('is_with_sound')->default(1);
            $table->string('response_status');
            $table->string('response_message');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('push_notifications');
    }
};
