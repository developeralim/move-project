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
        Schema::create('episodes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('seasion_id');
            $table->string('name');
            $table->string('slug');
            $table->string('cover_photo');
            $table->string('release_year');
            $table->string('relese_date');
            $table->string('quality');
            $table->string('drive_id');
            $table->text('description');
            $table->string('api_key');
            $table->integer('status')->default(1);
            $table->timestamps();
            $table->foreign('seasion_id')->references('id')->on('seasions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('episodes');
    }
};
