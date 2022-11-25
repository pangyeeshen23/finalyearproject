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
        Schema::table('admin_users', function(Blueprint $table){
            $table->string('email_address');
            $table->string('phone_number');
            $table->string('identity_card_number');
            $table->string('age');
            $table->date('birthday')->nullable();
            $table->boolean('is_approved');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('admin_users', function(Blueprint $table){
            $table->dropColumn('email_address');
            $table->dropColumn('phone_number');
            $table->dropColumn('identity_card_number');
            $table->dropColumn('age');
            $table->dropColumn('birthday');
            $table->dropColumn('is_approved');
        });
    }
};
