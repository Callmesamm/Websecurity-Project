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
      Schema::table('movies', function (Blueprint $table) {
    $table->string('original_title')->nullable();
    $table->text('overview')->nullable();
    $table->string('poster_path')->nullable();
    $table->string('backdrop_path')->nullable();
    $table->integer('runtime')->nullable();
    $table->float('vote_average')->nullable();
    $table->integer('vote_count')->nullable();
    $table->string('status')->nullable();
    $table->string('tagline')->nullable();
    $table->bigInteger('budget')->nullable();
    $table->bigInteger('revenue')->nullable();
    $table->string('homepage')->nullable();
    $table->string('imdb_id')->nullable();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('movies', function (Blueprint $table) {
            //
        });
    }
};
