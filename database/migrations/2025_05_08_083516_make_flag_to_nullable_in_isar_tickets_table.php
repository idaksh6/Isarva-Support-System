<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeFlagToNullableInIsarTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('isar_tickets', function (Blueprint $table) {
            $table->text('flag_to')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('isar_tickets', function (Blueprint $table) {
            $table->text('flag_to')->nullable(false)->change(); // Reverts to NOT NULL
        });
    }
}
