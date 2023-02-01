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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('review_movie_id');
            $table->unsignedBigInteger('member_id')->nullable();
            $table->string('review_title');
            $table->string('review_rate');
            $table->text('review_text')->nullable();
            $table->text('status')->default(1);
            $table->timestamps();

            $table->foreign('review_movie_id')->references('id')->on('movies')->onDelete('cascade');
            $table->foreign('member_id')->references('id')->on('members')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reviews');
    }
};
