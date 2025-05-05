<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeProjectTicketIdNullableInSiBackupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('si_backups', function (Blueprint $table) {
            $table->bigInteger('project_ticket_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('si_backups', function (Blueprint $table) {
            $table->bigInteger('project_ticket_id')->nullable(false)->change();
        });
    }
}
