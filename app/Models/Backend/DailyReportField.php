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
        return $this->belongsTo(User::class, 'user_id');
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
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

     // Relationship to DailyReport
     public function dailyReport() {
        return $this->belongsTo(DailyReport::class, 'daily_report_id');
    }

    public function getBillableTypeTextAttribute()
    {
        switch ($this->billable_type) {
            case 0:
                return 'Non-Billable';
            case 1:
                return 'Billable';
            case 2:
                return 'Internal Billable';
            default:
                return 'Unknown';
        }
    }

    public static function getTotalHours($filters, $billingType = null)
    {
        $query = self::query();

        // Apply date filter if provided
        if (!empty($filters['start_date']) && !empty($filters['end_date'])) {
            $query->whereBetween('created_at', [$filters['start_date'], $filters['end_date']]);
        }

        // Apply employee filter
        if (!empty($filters['employee'])) {
            $query->where('user_id', $filters['employee']);
        }

        // Apply project/ticket filter
        if (!empty($filters['project_ticket']) && !empty($filters['select_project'])) {
            if ($filters['project_ticket'] === 'project') {
                $query->where('type', 1)->where('project_name', $filters['select_project']);
            } elseif ($filters['project_ticket'] === 'ticket') {
                $query->where('type', 2)->where('project_name', $filters['select_project']);
            }
        }

        // Apply billing type filter if specific type is requested
        if ($billingType !== null) {
            $query->where('billable_type', $billingType);
            return $query->sum('hrs');
        }

        // Get totals for all types when no specific billing type is requested
        return [
            'billable' => $query->clone()->where('billable_type', 1)->sum('hrs'),
            'non_billable' => $query->clone()->where('billable_type', 0)->sum('hrs'),
            'internal_billable' => $query->clone()->where('billable_type', 2)->sum('hrs'),
        ];
    }


  
   
}
