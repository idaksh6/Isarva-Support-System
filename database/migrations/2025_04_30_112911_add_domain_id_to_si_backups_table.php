<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDomainIdToSiBackupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('si_backups', function (Blueprint $table) {
            $table->unsignedBigInteger('domain_id')->nullable()->after('domain');
        });
        
        // Assign incremental IDs to existing domains
        $domains = DB::table('si_backups')
                   ->select('domain')
                   ->distinct()
                   ->whereNotNull('domain')
                   ->get();
        
        $domainId = 1;
        foreach ($domains as $domain) {
            DB::table('si_backups')
              ->where('domain', $domain->domain)
              ->update(['domain_id' => $domainId++]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('si_backups', function (Blueprint $table) {
            //
        });
    }
}
