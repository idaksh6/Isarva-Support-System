<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->text('profile_image')->nullable()->after('password');
            $table->string('employee_id', 200)->nullable()->after('profile_image');
            $table->date('joining_date')->nullable()->after('employee_id');
            $table->string('user_name', 100)->after('joining_date');
            $table->string('phone', 30)->after('user_name');
            $table->text('webhook_url')->nullable()->after('phone');
            $table->integer('department')->after('webhook_url');
            $table->integer('designation')->after('department');
            $table->integer('status')->after('designation');
            $table->integer('role')->after('status');
            $table->string('address', 50)->after('role');
            $table->integer('is_salaried')->nullable()->after('address');
            $table->integer('is_marketing_person')->nullable()->after('is_salaried');
            $table->integer('access_all_tickets')->nullable()->after('is_marketing_person');
            $table->integer('report_required')->nullable()->after('access_all_tickets');
            $table->text('description')->nullable()->after('report_required');
            $table->bigInteger('created_by')->after('description');
            $table->bigInteger('updated_by')->after('created_by');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'profile_image',
                'employee_id',
                'joining_date',
                'user_name',
                'phone',
                'webhook_url',
                'department',
                'designation',
                'status',
                'role',
                'address',
                'is_salaried',
                'is_marketing_person',
                'access_all_tickets',
                'report_required',
                'description',
                'created_by',
                'updated_by',
            ]);
        });
    }
}
