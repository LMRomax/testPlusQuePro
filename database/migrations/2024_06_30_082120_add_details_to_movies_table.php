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
            $table->json('production_countries')->nullable();
            $table->json('origin_country')->nullable();
            $table->json('production_companies')->nullable();
            $table->json('spoken_languages')->nullable();
            $table->string('tagline')->nullable();
            $table->string('status')->nullable();
            $table->integer('revenue');
            $table->integer('runtime');
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
