<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiDailyTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('si_daily_tasks', function (Blueprint $table) {
            $table->id(); // id (bigint, primary)
            $table->unsignedBigInteger('user_id'); // user_id
            $table->string('type')->nullable(); // type (nullable)
            $table->unsignedBigInteger('project_ticket_id')->nullable(); // project_ticket_id
            $table->string('project_ticket_name', 500)->nullable(); // project_ticket_name
            $table->text('description'); // description
            $table->text('notes')->nullable(); // notes (nullable)
            $table->integer('status'); // status (int)
            $table->bigInteger('created_by'); // created_by
            $table->bigInteger('updated_by'); // updated_by
            $table->timestamps(); // created_at & updated_at
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('si_daily_tasks');
    }
}
