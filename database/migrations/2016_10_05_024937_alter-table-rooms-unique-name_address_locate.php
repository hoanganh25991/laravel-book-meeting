<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableRoomsUniqueNameAddressLocate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rooms', function () {
//            $table->unique(['name', 'address', 'locate']);
            //bcs address, locate are tinytext (too long key)
            DB::statement('CREATE UNIQUE INDEX rooms_name_address_locate_unique ON rooms (`name`, `address`(50), `locate`(50));');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rooms', function () {
            DB::statement('DROP INDEX rooms_name_address_locate_unique ON rooms;');
        });
    }
}
