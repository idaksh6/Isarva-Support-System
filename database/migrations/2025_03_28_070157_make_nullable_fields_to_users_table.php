<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeNullableFieldsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('user_name', 100)->nullable()->change();
            $table->string('phone', 30)->nullable()->change();
            $table->integer('department')->nullable()->change();
            $table->integer('designation')->nullable()->change();
            $table->integer('status')->nullable()->change();
            $table->integer('role')->nullable()->change();
            $table->string('address', 50)->nullable()->change();
            $table->bigInteger('created_by')->nullable()->change();
            $table->bigInteger('updated_by')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('user_name', 100)->nullable(false)->change();
            $table->string('phone', 30)->nullable(false)->change();
            $table->integer('department')->nullable(false)->change();
            $table->integer('designation')->nullable(false)->change();
            $table->integer('status')->nullable(false)->change();
            $table->integer('role')->nullable(false)->change();
            $table->string('address', 50)->nullable(false)->change();
            $table->bigInteger('created_by')->nullable(false)->change();
            $table->bigInteger('updated_by')->nullable(false)->change();
        });
    }
}
