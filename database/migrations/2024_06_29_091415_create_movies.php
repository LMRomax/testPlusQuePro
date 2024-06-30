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
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->integer('movie_id');
            $table->string('title');
            $table->string('original_title');
            $table->longText('overview');
            $table->longText('poster_path');
            $table->boolean('adult');
            $table->string('original_language');
            $table->json('genre_ids');
            $table->float('popularity');
            $table->date('release_date');
            $table->float('vote_average');
            $table->integer('vote_count');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movies');
    }
};
