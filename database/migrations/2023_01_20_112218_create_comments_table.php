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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('comment_movie_id');
            $table->string('comment_author')->nullable();
            $table->string('comment_author_url')->nullable();
            $table->unsignedBigInteger('comment_author_email')->nullable();
            $table->string('comment_author_ip')->nullable();
            $table->text('comment_content');
            $table->string('author_email');
            $table->text('comment');
            $table->integer('comment_parent')->default(0);
            $table->integer('comment_approved')->default(0);
            $table->string('comment_author_image')->nullable();
            $table->integer('status')->default(1);
            $table->timestamps();

            $table->foreign('comment_movie_id')->references('id')->on('movies')->onDelete('cascade');
            $table->foreign('comment_author_email')->references('id')->on('members')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
};
