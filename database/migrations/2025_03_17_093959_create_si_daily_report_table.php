<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiDailyReportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('si_daily_report', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->index();
            $table->float('total_time');
            $table->string('overall_status', 160);
            $table->bigInteger('created_by');
            $table->bigInteger('updated_by');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('si_daily_report');
    }
}
