<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('isar_ticket_discusion', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('ticket_id');
            $table->text('comments')->nullable();
            $table->dateTime('created_on');
            $table->dateTime('last_modified_on');
            $table->integer('comment_type')->default(0);
            $table->integer('is_client_reply')->default(0);
            $table->string('ip_address', 100);
            $table->text('attahcement')->nullable(); // Note: 'attachment' is misspelled


            // Indexes
            $table->index('user_id');
            $table->index('ticket_id');
            
            $table->timestamps(); // Only include if you need Laravel's default timestamps
        });
    }

    public function down()
    {
        Schema::dropIfExists('isar_ticket_discusion');
    }
};
