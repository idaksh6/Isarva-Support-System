<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDeletedAtToIsarClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('isar_clients', function (Blueprint $table) {
            $table->softDeletes(); // Adds deleted_at column
        });
    }

    public function down()
    {
        Schema::table('isar_clients', function (Blueprint $table) {
            $table->dropSoftDeletes(); // Removes deleted_at column
        });
    }

   
}
