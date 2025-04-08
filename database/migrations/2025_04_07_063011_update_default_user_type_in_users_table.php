<?php

use Illuminate\Database\Migrations\Migration;
use App\Domains\Auth\Models\User;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateDefaultUserTypeInUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        // Change default to TYPE_ADMIN
        DB::statement("ALTER TABLE users MODIFY type ENUM('" . User::TYPE_ADMIN . "', '" . User::TYPE_USER . "') DEFAULT '" . User::TYPE_ADMIN . "'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert default to TYPE_USER
        DB::statement("ALTER TABLE users MODIFY type ENUM('" . User::TYPE_ADMIN . "', '" . User::TYPE_USER . "') DEFAULT '" . User::TYPE_USER . "'");
    }
}
