<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiCredentialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('si_credentials', function (Blueprint $table) {
            $table->id(); // bigint, primary key
            $table->bigInteger('user_id');
            $table->bigInteger('project_id');
            $table->text('title');
            $table->string('description', 500);
            $table->bigInteger('created_by');
            $table->bigInteger('updated_by');
            $table->timestamps(); // created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('si_credentials');
    }
}
