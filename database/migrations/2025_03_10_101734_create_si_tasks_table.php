<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('si_tasks', function (Blueprint $table) {
            $table->id(); // Primary key, auto-incrementing bigint
            $table->bigInteger('project_id'); 
            $table->string('task_name', 100); 
            $table->string('description', 100);
            $table->dateTime('end_date'); 
            $table->integer('status')->length(11); 
            $table->bigInteger('assigned_to'); 
            $table->float('estimation_hrs'); 
            $table->bigInteger('created_by'); 
            $table->bigInteger('updated_by'); 
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('si_tasks');
    }
}
