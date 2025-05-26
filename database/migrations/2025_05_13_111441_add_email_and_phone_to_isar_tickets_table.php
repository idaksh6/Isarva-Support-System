<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEmailAndPhoneToIsarTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *   
     * @return void
     */
    public function up()
    {
        Schema::table('isar_tickets', function (Blueprint $table) {
             $table->string('email_id', 400)->nullable()->after('department');
            $table->string('phone_number', 40)->nullable()->after('email_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('isar_tickets', function (Blueprint $table) {
              $table->dropColumn('email_id');
            $table->dropColumn('phone_number');
        });
    }
}
