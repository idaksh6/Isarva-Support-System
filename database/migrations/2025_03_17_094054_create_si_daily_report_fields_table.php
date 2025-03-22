<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiDailyReportFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('si_daily_report_fields', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('daily_report_id')->index();
            $table->bigInteger('user_id')->index();
            $table->integer('type');
            $table->bigInteger('project_id')->index();
            $table->string('project_name', 200);
            $table->bigInteger('task_id')->index();
            $table->string('task_name', 200);
            $table->text('comments');
            $table->float('hrs');
            $table->text('link')->nullable();
            $table->integer('billable_type');
            $table->string('se_bill_company', 100)->nullable();
            $table->bigInteger('created_by');
            $table->bigInteger('updated_by');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('si_daily_report_fields');
    }
}
