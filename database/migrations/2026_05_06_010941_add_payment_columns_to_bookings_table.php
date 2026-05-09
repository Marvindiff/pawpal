<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bookings', function (Blueprint $table) {

            // ✅ ONLY ADD MISSING COLUMNS

            if (!Schema::hasColumn('bookings', 'payment_method')) {
                $table->string('payment_method')->nullable();
            }

            if (!Schema::hasColumn('bookings', 'gcash_proof')) {
                $table->string('gcash_proof')->nullable();
            }

            if (!Schema::hasColumn('bookings', 'payment_verified_at')) {
                $table->timestamp('payment_verified_at')->nullable();
            }

        });
    }

    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {

            $columns = [];

            if (Schema::hasColumn('bookings', 'payment_method')) {
                $columns[] = 'payment_method';
            }

            if (Schema::hasColumn('bookings', 'gcash_proof')) {
                $columns[] = 'gcash_proof';
            }

            if (Schema::hasColumn('bookings', 'payment_verified_at')) {
                $columns[] = 'payment_verified_at';
            }

            if (!empty($columns)) {
                $table->dropColumn($columns);
            }

        });
    }
};