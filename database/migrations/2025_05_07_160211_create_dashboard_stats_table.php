<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dashboard_stats', function (Blueprint $table) {
            $table->id();
            $table->integer('total_movies')->default(0);
            $table->integer('total_shows')->default(0);
            $table->integer('total_reservations')->default(0);
            $table->integer('total_users')->default(0);
            $table->decimal('total_revenue', 10, 2)->default(0);
            $table->integer('total_views')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dashboard_stats');
    }
}; 