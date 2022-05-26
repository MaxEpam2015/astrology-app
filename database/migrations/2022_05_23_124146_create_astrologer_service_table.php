<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAstrologerServiceTable extends Migration
{
    public function up(): void
    {
        Schema::create('astrologer_service', function(Blueprint $table) {
            $table->uuid('astrologer_uuid');
            $table->foreign('astrologer_uuid')
                ->references('uuid')
                ->on('astrologers')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->uuid('service_uuid');
            $table->foreign('service_uuid')
                ->references('uuid')
                ->on('services')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('astrologer_service');
    }
}
