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
        Schema::create('driver_applications', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger("creator_id");
            $table->foreign("creator_id")->references('id')->on('admin_users')->onDelete('cascade');
            $table->string("file_name");
            $table->string("file_link");
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
        Schema::table('driver_applications', function(Blueprint $table){
            $table->dropForeign(['creator_id']);
        });
        Schema::dropIfExists('driver_applications');
    }
};
