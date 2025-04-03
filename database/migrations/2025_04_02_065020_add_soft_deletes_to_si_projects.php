<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSoftDeletesToSiProjects extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('si_projects', function (Blueprint $table) {
            if (!Schema::hasColumn('si_projects', 'deleted_at')) {
                $table->softDeletes(); // Adds `deleted_at` column
            }
        });
    }

    public function down()
    {
        Schema::table('si_projects', function (Blueprint $table) {
            if (Schema::hasColumn('si_projects', 'deleted_at')) {
                $table->dropColumn('deleted_at'); // Rolls back `deleted_at`
            }
        });
    }
}
