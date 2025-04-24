<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeEstimationHrsToDecimalInSiTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('si_tasks', function (Blueprint $table) {
            $table->decimal('estimation_hrs', 8, 2)->change(); // Change FLOAT to DECIMAL
        });
    }
    
    public function down()
    {
        Schema::table('si_tasks', function (Blueprint $table) {
            $table->float('estimation_hrs')->change(); // Revert to FLOAT if needed
        });
    }
}
