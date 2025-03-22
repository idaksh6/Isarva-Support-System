<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('si_users', function (Blueprint $table) {
            $table->id(); // BigInt Primary Key
            $table->string('name', 100);
            $table->text('profile_image')->nullable();
            $table->string('employee_id', 200)->nullable();
            $table->date('joining_date');
            $table->string('user_name', 100);
            $table->string('password', 250);
            $table->string('email_id', 40)->unique();
            $table->string('phone', 30);
            $table->text('webhook_url')->nullable();
            $table->integer('department')->length(20);
            $table->integer('designation')->length(20);
            $table->integer('status')->length(11);
            $table->integer('role')->length(11);
            $table->string('address', 50);
            $table->integer('is_salaried')->nullable();
            $table->integer('is_marketing_person')->nullable();
            $table->integer('access_all_tickets')->nullable();
            $table->integer('report_required')->nullable();
            $table->text('description')->nullable();
            $table->timestamps(); // created_at & updated_at
            $table->bigInteger('created_by');
            $table->bigInteger('updated_by');
        });
    }

    public function down(): void {
        Schema::dropIfExists('si_users');
    }
};

