<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('astrologer_uuid');
            $table->foreign('astrologer_uuid')
                ->references('uuid')
                ->on('astrologers')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('name');
            $table->string('email');
            $table->string('uuid')->unique();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
