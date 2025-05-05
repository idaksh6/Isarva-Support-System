<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterDriveLinkNullableInSiBackupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('si_backups', function (Blueprint $table) {
            $table->string('drive_link', 500)->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('si_backups', function (Blueprint $table) {
            $table->string('drive_link', 500)->nullable(false)->change();
        });
    }
}
