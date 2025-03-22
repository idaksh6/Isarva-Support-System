<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyReportField extends Model
{
    use HasFactory;

    
    protected $table = 'si_daily_report_fields';

    protected $fillable = [
        'daily_report_id',
        'user_id',
        'type',
        'project_id',
        'project_name',
        'task_id',
        'task_name',
        'comments',
        'hrs',
        'link',
        'billable_type',
        'se_bill_company',
        'created_by',
        'updated_by',
    ];

    public function user()
    {
        return $this->belongsTo(Employee::class, 'user_id');
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function task()
    {
        return $this->belongsTo(Task::class, 'task_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(Employee::class, 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(Employee::class, 'updated_by');
    }

     // Relationship to DailyReport
     public function dailyReport() {
        return $this->belongsTo(DailyReport::class, 'daily_report_id');
    }
}
