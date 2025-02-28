<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('isar_clients', function (Blueprint $table) {
            $table->string('client_pos_in_comp', 400)->nullable()->after('client_name');
        });
    }

    public function down(): void
    {
        Schema::table('isar_clients', function (Blueprint $table) {
            $table->dropColumn('client_pos_in_comp');
        });
    }
};

