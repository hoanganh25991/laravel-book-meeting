<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableBookingUserBookingNUserUnique extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::table('booking_user', function(Blueprint $table){
//            $table->unique(['booking_id', 'user_id']);
//        });
//        DB::statement('ALTER TABLE booking_user ADD UNIQUE KEY `booking_user_booking_id_user_id_unique` (`booking_id`, `user_id`)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
//        Schema::table('booking_user', function(Blueprint $table){
//            $table->dropUnique('booking_user_booking_user_unique');
//        });
    }
}
