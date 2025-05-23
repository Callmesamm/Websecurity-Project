<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('movie_actor', function (Blueprint $table) {
            $table->string('character_name')->nullable();
            $table->integer('order_number')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('movie_actor', function (Blueprint $table) {
            $table->dropColumn(['character_name', 'order_number']);
        });
    }
};
