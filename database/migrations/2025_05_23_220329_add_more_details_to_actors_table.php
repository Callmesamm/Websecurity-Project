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
    Schema::table('actors', function (Blueprint $table) {
        $table->text('biography')->nullable();
        $table->date('birth_date')->nullable();
        $table->date('death_date')->nullable();
        $table->string('place_of_birth')->nullable();
    });
}

public function down(): void
{
    Schema::table('actors', function (Blueprint $table) {
        $table->dropColumn(['biography', 'birth_date', 'death_date', 'place_of_birth']);
    });
}
};
