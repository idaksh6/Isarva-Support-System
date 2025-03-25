<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIsarTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('isar_tickets', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key (ID)
            $table->string('title', 500); // Title column
            $table->text('domain')->nullable(); // Domain column, nullable
            $table->integer('priority'); // Priority column
            $table->unsignedBigInteger('project')->nullable(); // Project column, nullable
            $table->string('client', 200); // Client column
            $table->integer('type'); // Type column
            $table->integer('source'); // Source column
            $table->longText('comments')->nullable(); // Comments column, nullable
            $table->dateTime('last_modified_on'); // Last modified on column
            $table->dateTime('last_flagged_on')->nullable(); // Last flagged on column, nullable
            $table->integer('privacy'); // Privacy column
            $table->text('team_members'); // Team members column
            $table->text('flag_to'); // Flag to column
            $table->integer('status'); // Status column
            $table->dateTime('start_date'); // Start date column
            $table->unsignedBigInteger('department'); // Department column
            $table->dateTime('end_date'); // End date column
            $table->text('close_comment')->nullable(); // Close comment column, nullable
            $table->unsignedBigInteger('last_updated_by'); // Last updated by column
            $table->dateTime('created_on'); // Created on column
            $table->unsignedBigInteger('created_by'); // Created by column
            $table->integer('is_client'); // Is client column
            $table->string('email_cc_list', 500); // Email CC list column
            $table->unsignedBigInteger('last_status_closed_by')->nullable(); // Last status closed by column, nullable
            $table->dateTime('last_status_closed_on')->nullable(); // Last status closed on column, nullable
            $table->string('ip_address', 50); // IP address column
            $table->integer('closing_status')->nullable(); // Closing status column, nullable
            $table->timestamps(); // Adds `created_at` and `updated_at` columns
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('isar_tickets');
    }
}