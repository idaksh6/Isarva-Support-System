<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiBackupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('si_backups', function (Blueprint $table) {
            $table->id(); // bigIncrements
            $table->bigInteger('project_ticket');
            $table->bigInteger('project_ticket_id');
            $table->string('domain', 100);
            $table->string('present_ip', 100);
            $table->string('last_backup_file_name', 500);
            $table->date('last_backup_date');
            $table->string('last_backup_location', 500);
            $table->integer('backup_type');
            $table->string('wordpress_version', 25)->nullable();
            $table->string('php_version', 25)->nullable();
            $table->integer('site_status');
            $table->string('framework_version', 100)->nullable();
            $table->string('drive_link', 500);
            $table->string('description', 500)->nullable();
            $table->bigInteger('created_by'); // created_by
            $table->bigInteger('updated_by'); // updated_by
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('si_backups');
    }
}
