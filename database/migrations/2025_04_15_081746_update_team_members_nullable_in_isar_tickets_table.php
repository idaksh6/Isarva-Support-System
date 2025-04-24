<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTeamMembersNullableInIsarTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('isar_tickets', function (Blueprint $table) {
            $table->text('team_members')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('isar_tickets', function (Blueprint $table) {
            $table->text('team_members')->nullable(false)->change();
        });
    }
}
