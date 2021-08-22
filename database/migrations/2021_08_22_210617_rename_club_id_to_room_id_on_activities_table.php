<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameClubIdToRoomIdOnActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('activities', function (Blueprint $table) {
            $table->renameColumn('club_id', 'room_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('activities', function (Blueprint $table) {
            $table->renameColumn('room_id', 'club_id');
        });
    }
}
