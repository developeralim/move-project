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
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('user_name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('payment_id')->nullable();
            $table->string('payment_gateway')->nullable();
            $table->string('membership_code')->nullable();
            $table->float('price')->nullable();
            $table->float('total')->nullable();
            $table->string('coupon')->nullable();
            $table->string('package')->nullable();
            $table->string('invoice_code')->nullable();
            $table->float('discount')->nullable();
            $table->text('transection_doc')->nullable();
            $table->text('address')->nullable();
            $table->string('user_image')->nullable();
            $table->text('user_location_details')->nullable();
            $table->string('city')->nullable();
            $table->string('zip')->nullable();
            $table->string('state')->nullable();
            $table->string('mobile_no')->nullable();
            $table->string('status_paid')->default('Unpaid');
            $table->integer('status')->default('1');
            $table->rememberToken();
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
        Schema::dropIfExists('members');
    }
};