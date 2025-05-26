<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('client_id');
            $table->bigInteger('project_id');
            
            // Domain fields
            $table->integer('d_service')->nullable();
            $table->string('d_name', 500)->nullable();
            $table->date('d_exp')->nullable();
            
            // Hosting fields
            $table->integer('h_service')->nullable();
            $table->string('h_ip', 500)->nullable();
            $table->date('h_exp')->nullable();
            
            // Application fields (note: fixed typo from your request - a_serive to a_service)
            $table->integer('a_service')->nullable();
            $table->string('a_name', 500)->nullable();
            $table->date('a_exp')->nullable();
            
            // Common fields
            $table->string('provider', 50);
            $table->decimal('renewal_cost', 10, 2)->nullable();
            $table->enum('priority', ['normal', 'upcoming', 'urgent'])->nullable();
            $table->text('notes')->nullable();
            $table->tinyInteger('auto_renew')->nullable();
            
            // Timestamps and soft deletes
            $table->timestamps();
            $table->softDeletes();
        });
    

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('services');
    }
}
