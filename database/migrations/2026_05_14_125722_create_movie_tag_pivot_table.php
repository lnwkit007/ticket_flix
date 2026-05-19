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
        Schema::create('movie_tag_pivot', function (Blueprint $table) {
            $table->id();

            $table->foreignId('movie_id')->constrained('movies')->onDelete('cascade');
            $table->foreignId('movie_tag_id')->constrained('movie_tag')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movie_tag_pivot');
    }
};
