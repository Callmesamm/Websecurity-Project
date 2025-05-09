<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('movies', function (Blueprint $table) {
            // $table->string('status')->nullable(); // تم حذفه لتفادي التكرار
            // $table->string('tagline')->nullable(); // تم حذفه لتفادي التكرار
            // $table->bigInteger('budget')->nullable(); // تم حذفه لتفادي التكرار
            // $table->bigInteger('revenue')->nullable(); // تم حذفه لتفادي التكرار
            // $table->string('homepage')->nullable(); // تم حذفه لتفادي التكرار
            // $table->string('imdb_id')->nullable(); // تم حذفه لتفادي التكرار
            // $table->bigInteger('tmdb_id')->nullable()->index(); // تم حذفه لتفادي التكرار
        });
    }

    public function down()
    {
        Schema::table('movies', function (Blueprint $table) {
            $table->dropColumn([
                // 'status', // تم حذفه لتفادي التكرار
                // 'tagline', // تم حذفه لتفادي التكرار
                // 'budget', // تم حذفه لتفادي التكرار
                // 'revenue', // تم حذفه لتفادي التكرار
                // 'homepage', // تم حذفه لتفادي التكرار
                // 'imdb_id', // تم حذفه لتفادي التكرار
                // 'tmdb_id', // تم حذفه لتفادي التكرار
            ]);
        });
    }
}; 