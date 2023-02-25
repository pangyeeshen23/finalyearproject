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
        Schema::create('travel_plans', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->string('meeting_point');
            $table->string('depart_name');
            $table->decimal('depart_lat');
            $table->decimal('depart_long');
            $table->string('destination_name');
            $table->decimal('destination_lat');
            $table->decimal('destination_long');
            $table->decimal('fees');
            $table->boolean('is_student');
            $table->unsignedInteger('creator_id');
            $table->foreign('creator_id')->references('id')->on('admin_users')->onDelete('cascade');
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
        Schema::dropIfExists('travel_plans');
    }
};
