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
        Schema::create('seasions', function (Blueprint $table) {
            $table->id();
            $table->string('seasion_name')->unique();
            $table->string('slug')->unique();
            $table->text('seasion_desc')->nullable();
            $table->integer('seasion_episod_count')->default(0);
            $table->integer('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seasions');
    }
};
