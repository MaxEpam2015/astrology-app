<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('astrologers', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('uuid')->index();
            $table->string('name');
            $table->text('photo');
            $table->string('email')->unique();
            $table->text('biography');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('astrologers');
    }
};
