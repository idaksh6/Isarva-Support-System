<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeGroupIdToStringInSiBackupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 1. Add a temporary string column
        Schema::table('si_backups', function (Blueprint $table) {
            $table->string('temp_group_id')->nullable()->after('group_id');
        });

        // 2. Convert existing integer group_ids to string format
        // For projects (type=1)
        DB::table('si_backups')
            ->where('project_ticket', 1)
            ->update(['temp_group_id' => DB::raw("CONCAT('P_', project_ticket_id)")]);

        // For tickets (type=2)
        DB::table('si_backups')
            ->where('project_ticket', 2)
            ->update(['temp_group_id' => DB::raw("CONCAT('T_', project_ticket_id)")]);

        // For others (type=3 or null)
        DB::table('si_backups')
            ->where(function ($query) {
                $query->where('project_ticket', 3)
                      ->orWhereNull('project_ticket');
            })
            ->update(['temp_group_id' => DB::raw("CONCAT('D_', LOWER(domain))")]);

        // For any remaining records (fallback to old group_id)
        DB::table('si_backups')
            ->whereNull('temp_group_id')
            ->update(['temp_group_id' => DB::raw("CONCAT('G_', group_id)")]);

        // 3. Drop the old group_id column
        Schema::table('si_backups', function (Blueprint $table) {
            $table->dropColumn('group_id');
        });

        // 4. Rename temp_group_id to group_id
        Schema::table('si_backups', function (Blueprint $table) {
            $table->renameColumn('temp_group_id', 'group_id');
        });

        // 5. Make group_id non-nullable
        Schema::table('si_backups', function (Blueprint $table) {
            $table->string('group_id')->nullable(false)->change();
        });
    }

    public function down()
    {
        // Reverse the migration if needed
        Schema::table('si_backups', function (Blueprint $table) {
            $table->unsignedBigInteger('temp_group_id')->nullable()->after('group_id');
        });

        // Try to convert back to integers (will only work for numeric parts)
        DB::table('si_backups')
            ->update([
                'temp_group_id' => DB::raw("CAST(SUBSTRING(group_id, 3) AS UNSIGNED)")
            ]);

        Schema::table('si_backups', function (Blueprint $table) {
            $table->dropColumn('group_id');
            $table->renameColumn('temp_group_id', 'group_id');
            $table->unsignedBigInteger('group_id')->nullable(false)->change();
        });
    }
}
