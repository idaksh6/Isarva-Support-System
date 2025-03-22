<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTaskCategoryToSiTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('si_tasks', function (Blueprint $table) {
            $table->integer('task_category')->nullable()->after('task_name');
        });
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('si_tasks', function (Blueprint $table) {
            $table->dropColumn('task_category');
        });
    }

}
