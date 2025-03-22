<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiProjectInternalDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('si_project_internal_documents', function (Blueprint $table) {
            $table->id(); // BigInt Primary Key
            $table->bigInteger('project_id'); // Foreign key to projects table
            $table->date('date'); // Date of the document
            $table->text('title'); // Title of the document
            $table->text('link')->nullable(); // Link to the document (optional)
            $table->text('comments'); // Comments about the document
            $table->integer('raw_index')->nullable(); // Raw index (optional)
            $table->bigInteger('created_by'); // User ID who created the document
            $table->bigInteger('updated_by'); // User ID who last updated the document
            $table->timestamps(); // created_at and updated_at timestamps
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('si_project_internal_documents');
    }
}
