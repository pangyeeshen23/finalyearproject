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
        Schema::create('user_travel_plans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('travel_plans_id');
            $table->unsignedInteger('creator_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('travel_plans_id')->references('id')->on('travel_plans');
            $table->foreign("creator_id")->references('id')->on('admin_users')->onDelete('cascade');
            $table->integer('rate')->nullable();
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
        Schema::dropIfExists('user_travel_plans');
    }
};
