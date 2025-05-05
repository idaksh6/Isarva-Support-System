<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGroupIdToSiBackupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        // 1. Add the column as nullable first
        Schema::table('si_backups', function (Blueprint $table) {
            $table->unsignedBigInteger('group_id')->nullable()->after('id');
        });
        
        // 2. Generate group_ids for existing records
        $domains = DB::table('si_backups')->select('domain')->distinct()->get();
        $group_id = 1;
        
        foreach ($domains as $domain) {
            DB::table('si_backups')
                ->where('domain', $domain->domain)
                ->update(['group_id' => $group_id++]);
        }
        
        // 3. Now make the column non-nullable
        Schema::table('si_backups', function (Blueprint $table) {
            $table->unsignedBigInteger('group_id')->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('si_backups', function (Blueprint $table) {
            $table->dropColumn('group_id');
        });
    }
}
