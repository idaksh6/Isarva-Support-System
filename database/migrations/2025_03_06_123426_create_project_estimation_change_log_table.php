<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectEstimationChangeLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_estimation_change_log', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_id');
            $table->unsignedBigInteger('change_req_by')->nullable();;
            $table->unsignedBigInteger('changed_by');
            $table->text('reason');
            $table->decimal('changed_from', 10, 2);
            $table->decimal('changed_to', 10, 2);
            $table->decimal('diff', 10, 2);
            $table->enum('approval_status', ['pending', 'approved', 'rejected'])->nullable();;
            $table->bigInteger('change_approved_by')->nullable();
            $table->bigInteger('change_rejected_by')->nullable();
            $table->string('reason_for_rejection', 200)->nullable();
            $table->integer('manager_notify_status')->nullable();;
            $table->integer('requester_notify_status')->nullable();;
            $table->bigInteger('created_by');
            $table->bigInteger('updated_by');
            $table->timestamps(); // created_at & updated_at
    
            // Foreign keys
            $table->foreign('project_id')->references('id')->on('si_projects');
            $table->foreign('changed_by')->references('id')->on('si_users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project_estimation_change_log');
    }
}
