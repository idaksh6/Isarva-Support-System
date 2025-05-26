<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTypeUsernamePasswordFieldsToSiCredentialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('si_credentials', function (Blueprint $table) {
            // Add 'type' after 'title' (int(11) equivalent)
            $table->integer('type')->after('title');

            // Add 'username' and 'password' (nullable)
            $table->string('username', 500)->nullable()->after('type');
            $table->string('password', 500)->nullable()->after('username');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('si_credentials', function (Blueprint $table) {
            //
              $table->dropColumn(['type', 'username', 'password']);
        });
    }
}
