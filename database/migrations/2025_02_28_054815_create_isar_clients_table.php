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
        Schema::create('isar_clients', function (Blueprint $table) {
            $table->id(); // id (Primary Key, BigInt, Auto Increment)
            $table->string('client_name', 400);
            $table->string('company_name', 400)->nullable();
            $table->text('profile_image')->nullable();
            $table->string('user_name', 200);
            $table->string('password', 500);
            $table->string('email_id', 400);
            $table->string('phone', 400);
            $table->text('description')->nullable();
            $table->timestamps(); // created_at & updated_at
            $table->bigInteger('created_by');
            $table->bigInteger('updated_by');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('isar_clients');
    }
};

