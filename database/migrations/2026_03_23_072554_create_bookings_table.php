<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();

            // MUST MATCH users.id
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('provider_id');

            $table->dateTime('schedule');
            $table->string('status')->default('pending');

            $table->timestamps();

            // FOREIGN KEYS
            //$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            //$table->foreign('provider_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};