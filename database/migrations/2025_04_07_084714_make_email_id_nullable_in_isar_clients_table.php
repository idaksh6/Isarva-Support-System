<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeEmailIdNullableInIsarClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('isar_clients', function (Blueprint $table) {
            $table->string('email_id', 400)->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('isar_clients', function (Blueprint $table) {
            $table->string('email_id', 400)->nullable(false)->change();
        });
    }
}
