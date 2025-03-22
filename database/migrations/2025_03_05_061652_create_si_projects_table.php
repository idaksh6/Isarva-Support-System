<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('si_projects', function (Blueprint $table) {
            $table->id(); // bigint, primary key
            $table->bigInteger('client'); 
            $table->string('project_name', 100);
            $table->integer('category')->nullable();
            $table->text('project_image')->nullable();
            $table->integer('manager');
            $table->integer('team_leader');
            $table->text('team_members');
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('department');
            $table->integer('status');
            $table->decimal('budget', 10, 2)->nullable(); // 10 digits, 2 decimal places
            $table->integer('priority');
            $table->integer('type');
            $table->float('estimation');
            $table->integer('biiling_company')->nullable(); // Corrected spelling from billing_company
            $table->string('description', 200);
            $table->integer('change_estimation')->nullable();
            $table->string('change_estimation_reason', 400)->nullable();
            $table->bigInteger('created_by');
            $table->bigInteger('updated_by');
            $table->timestamps(); // created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('si_projects');
    }
};
