<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FixProjectEstimationChangeLogUserForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('project_estimation_change_log', function (Blueprint $table) {
            // Drop the old foreign key constraint if it exists
            $table->dropForeign(['changed_by']);
            
            // Add new foreign key constraint pointing to users table
            $table->foreign('changed_by')
                  ->references('id')
                  ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('project_estimation_change_log', function (Blueprint $table) {
            // Drop the new foreign key
            $table->dropForeign(['changed_by']);
            
            // Recreate the old foreign key (pointing to si_users) for rollback
            $table->foreign('changed_by')
                  ->references('id')
                  ->on('si_users');
        });
    }
}
