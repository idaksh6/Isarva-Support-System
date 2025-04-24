<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyOverallStatusColumnInSiDailyReportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('si_daily_report', function (Blueprint $table) {
            $table->text('overall_status')->change(); // change to text
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('si_daily_report', function (Blueprint $table) {
            $table->string('overall_status', 160)->change(); // revert to original
        });
    }
}
