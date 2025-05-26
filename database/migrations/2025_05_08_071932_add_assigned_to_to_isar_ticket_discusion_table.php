<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAssignedToToIsarTicketDiscusionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('isar_ticket_discusion', function (Blueprint $table) {
            $table->text('assigned_to')->nullable()->after('attahcement');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('isar_ticket_discusion', function (Blueprint $table) {
            //
            $table->dropColumn('assigned_to');
        });
    }
}
