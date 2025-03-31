<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiProjectsAdditionalHrsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('si_projects_additional_hrs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('project_id');
            $table->text('description');
            $table->text('comments')->nullable();
            $table->float('hrs')->nullable();
            $table->date('date')->nullable();
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
        Schema::dropIfExists('si_projects_additional_hrs');
    }
}
