<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::table('shows', function (Blueprint $table) {
        // First check if the column already exists
        if (!Schema::hasColumn('shows', 'hall_id')) {
            $table->foreignId('hall_id')->after('movie_id')->nullable()->constrained('halls')->onDelete('set null');
        }
    });
}

public function down(): void
{
    Schema::table('shows', function (Blueprint $table) {
        $table->dropForeign(['hall_id']);
        $table->dropColumn('hall_id');
    });
}
};
