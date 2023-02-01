<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movie_seasion_relationships', function (Blueprint $table) {
            $table->id();
            $table->foreignId('movie_id')->nullable()->constrained('movies')->onDelete('cascade');
            $table->foreignId('seasion_id')->nullable()->constrained('seasions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movie_seasion_relationships');
    }
};
