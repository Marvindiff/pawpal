<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    public function up()
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->decimal('price', 10, 2)->change(); // ✅ FIX
        });
    }

    public function down()
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->decimal('price', 5, 2)->change();
        });
    }
};
