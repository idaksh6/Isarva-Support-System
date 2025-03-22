<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('si_project_assets', function (Blueprint $table) {
            $table->id(); // BigInt Primary Key
            $table->bigInteger('project_id');
            $table->bigInteger('user_id');
            $table->text('image_path');
            $table->text('filename');
            $table->integer('is_image')->default(0);
            $table->dateTime('uploaded_time');
            $table->bigInteger('created_by');
            $table->timestamp('updated_at')->nullable();
            $table->bigInteger('updated_by')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('si_project_assets');
    }
};

