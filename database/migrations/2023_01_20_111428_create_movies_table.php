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
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('admin_id')->nullable();
            $table->string('name')->unique();
            $table->string('slug');
            $table->string('cover_photo');
            $table->string('poster_image')->nullable();
            $table->string('relese_year');
            $table->string('running_time_minute');
            $table->string('country');
            $table->float('movie_review')->nullable();
            $table->string('age')->nullable();
            $table->string('movie_meta')->nullable();
            $table->string('quality')->nullable();
            $table->text('description')->nullable();
            $table->string('drive_id');
            $table->string('api_key')->nullable();
            $table->integer('status')->default(1);
            $table->timestamps();
            $table->foreign('admin_id')->references('id')->on('admins')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movies');
    }
};