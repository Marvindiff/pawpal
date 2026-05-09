<?php 

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sitter_verifications', function (Blueprint $table) {
            $table->id();

            // IMPORTANT: match users.id
            $table->unsignedBigInteger('user_id');

            $table->string('document')->nullable();
            $table->string('status')->default('pending');

            $table->timestamps();

            // MANUAL foreign key (safer)
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sitter_verifications');
    }
};