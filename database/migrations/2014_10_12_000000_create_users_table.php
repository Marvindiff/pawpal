<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // IMPORTANT

            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');

            $table->string('role')->default('user');
            $table->string('service_type')->nullable();
            $table->boolean('is_available')->default(false);
            $table->string('status')->default('pending');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};