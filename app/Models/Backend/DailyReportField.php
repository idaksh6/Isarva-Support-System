<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
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

    // public function user()
    // {
    //     return $this->belongsTo(User::class, 'user_id');
    // }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
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

   // FOR BILLABLE NON BILLABLE REPORTS
    public static function getTotalHours($filters, $billingType = null)
    {
        $query = self::query();

        // Apply date filter if provided
        if (!empty($filters['start_date']) && !empty($filters['end_date'])) {
            $query->where('created_at', '>=', $filters['start_date'])
                ->where('created_at', '<=', Carbon::parse($filters['end_date'])->endOfDay());
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

   
    // for consolidated report
    public static function getConsolidatedReportData($startDate, $endDate)
    {
        // Start query for users with reports - now including department
        $query = self::select('user_id')->with('user:id,name,department');

        // // Apply date range filter only if dates are provided
        // if ($startDate && $endDate) {
        //     $query->whereBetween('created_at', [$startDate, $endDate]);
        // }

          // Apply date range filter only if dates are provided
        if ($startDate && $endDate) {
            $endDate = Carbon::parse($endDate)->endOfDay()->toDateTimeString();
            $query->whereBetween('created_at', [$startDate, $endDate]);
        }

        $users = $query->groupBy('user_id')->get();

        $reportData = [];
        $departmentData = [
            'backend' => [
                'name' => 'DEVELOPMENT / BACKEND-TEAM',
                'employees' => [],
                'totals' => [
                    'billable' => 0,
                    'non_billable' => 0,
                    'internal' => 0,
                    'project_billable' => 0,
                    'project_non_billable' => 0,
                    'project_internal' => 0,
                    'ticket_billable' => 0,
                    'ticket_non_billable' => 0,
                    'ticket_internal' => 0,
                ]
            ],
            'frontend' => [
                'name' => 'WEBSITE / FRONT-END TEAM',
                'employees' => [],
                'totals' => [
                    'billable' => 0,
                    'non_billable' => 0,
                    'internal' => 0,
                    'project_billable' => 0,
                    'project_non_billable' => 0,
                    'project_internal' => 0,
                    'ticket_billable' => 0,
                    'ticket_non_billable' => 0,
                    'ticket_internal' => 0,
                ]
            ],
            'internship' => [
                'name' => 'INTERNSHIP',
                'employees' => [],
                'totals' => [
                    'billable' => 0,
                    'non_billable' => 0,
                    'internal' => 0,
                    'project_billable' => 0,
                    'project_non_billable' => 0,
                    'project_internal' => 0,
                    'ticket_billable' => 0,
                    'ticket_non_billable' => 0,
                    'ticket_internal' => 0,
                ]
            ]
        ];

        $globalTotals = [
            'billable' => 0,
            'non_billable' => 0,
            'internal' => 0,
            'project_billable' => 0,
            'project_non_billable' => 0,
            'project_internal' => 0,
            'ticket_billable' => 0,
            'ticket_non_billable' => 0,
            'ticket_internal' => 0,
            'project_total' => 0,
            'ticket_total' => 0
        ];

        foreach ($users as $user) {
            // Determine department
            $department = 'backend'; // default
            if ($user->user->department == 1) {
                $department = 'frontend';
            } elseif ($user->user->department == 3) {
                $department = 'internship';
            }

            // Get user entries
            $entriesQuery = self::where('user_id', $user->user_id)
                ->selectRaw('type, billable_type, SUM(hrs) as total_hrs')
                ->groupBy('type', 'billable_type');

            if ($startDate && $endDate) {
                $entriesQuery->whereBetween('created_at', [$startDate, $endDate]);
            }

            $entries = $entriesQuery->get();

            // Initialize hours
            $billableHrs = 0;
            $nonBillableHrs = 0;
            $internalHrs = 0;
            $projectBillable = 0;
            $projectNonBillable = 0;
            $projectInternal = 0;
            $ticketBillable = 0;
            $ticketNonBillable = 0;
            $ticketInternal = 0;

            foreach ($entries as $entry) {
                switch ($entry->billable_type) {
                    case 1: // Billable
                        if ($entry->type == 1) { // Project
                            $projectBillable += $entry->total_hrs;
                        } else { // Ticket
                            $ticketBillable += $entry->total_hrs;
                        }
                        $billableHrs += $entry->total_hrs;
                        break;
                    case 0: // Non-Billable
                        if ($entry->type == 1) { // Project
                            $projectNonBillable += $entry->total_hrs;
                        } else { // Ticket
                            $ticketNonBillable += $entry->total_hrs;
                        }
                        $nonBillableHrs += $entry->total_hrs;
                        break;
                    case 2: // Internal
                        if ($entry->type == 1) { // Project
                            $projectInternal += $entry->total_hrs;
                        } else { // Ticket
                            $ticketInternal += $entry->total_hrs;
                        }
                        $internalHrs += $entry->total_hrs;
                        break;
                }
            }

            // Calculate total hours for percentage
            $totalHrs = $billableHrs + $nonBillableHrs + $internalHrs;
            $baseHrs = $totalHrs > 0 ? $totalHrs : 8;

            // Create employee record
            $employeeRecord = [
                'si_no' => count($reportData) + 1,
                'user_id' => $user->user_id,
                'employee_name' => $user->user->name,
                'billable_hrs' => $billableHrs,
                'billable_percent' => ($billableHrs / $baseHrs) * 100,
                'non_billable_hrs' => $nonBillableHrs,
                'non_billable_percent' => ($nonBillableHrs / $baseHrs) * 100,
                'internal_hrs' => $internalHrs,
                'internal_percent' => ($internalHrs / $baseHrs) * 100,
                'project_billable' => $projectBillable,
                'project_non_billable' => $projectNonBillable,
                'project_internal' => $projectInternal,
                'ticket_billable' => $ticketBillable,
                'ticket_non_billable' => $ticketNonBillable,
                'ticket_internal' => $ticketInternal,
            ];

            // Add to department
            $departmentData[$department]['employees'][] = $employeeRecord;
            
            // Update department totals
            $departmentData[$department]['totals']['billable'] += $billableHrs;
            $departmentData[$department]['totals']['non_billable'] += $nonBillableHrs;
            $departmentData[$department]['totals']['internal'] += $internalHrs;
            $departmentData[$department]['totals']['project_billable'] += $projectBillable;
            $departmentData[$department]['totals']['project_non_billable'] += $projectNonBillable;
            $departmentData[$department]['totals']['project_internal'] += $projectInternal;
            $departmentData[$department]['totals']['ticket_billable'] += $ticketBillable;
            $departmentData[$department]['totals']['ticket_non_billable'] += $ticketNonBillable;
            $departmentData[$department]['totals']['ticket_internal'] += $ticketInternal;

            // Update global totals
            $globalTotals['billable'] += $billableHrs;
            $globalTotals['non_billable'] += $nonBillableHrs;
            $globalTotals['internal'] += $internalHrs;
            $globalTotals['project_billable'] += $projectBillable;
            $globalTotals['project_non_billable'] += $projectNonBillable;
            $globalTotals['project_internal'] += $projectInternal;
            $globalTotals['ticket_billable'] += $ticketBillable;
            $globalTotals['ticket_non_billable'] += $ticketNonBillable;
            $globalTotals['ticket_internal'] += $ticketInternal;
        }

        // Calculate final project and ticket totals
        $globalTotals['project_total'] = $globalTotals['project_billable'] + $globalTotals['project_non_billable'] + $globalTotals['project_internal'];
        $globalTotals['ticket_total'] = $globalTotals['ticket_billable'] + $globalTotals['ticket_non_billable'] + $globalTotals['ticket_internal'];

        return [
            'department_data' => $departmentData,
            'totals' => $globalTotals
        ];
    }
        

    //  Employee analytics report calculation
    public function getEmployeeStats($startDate, $endDate)
    {
        return DB::table('si_daily_report_fields as d')
            ->join('users as u', 'u.id', '=', 'd.user_id')
            ->selectRaw("
                d.user_id,
                u.name as employee_name,
                u.department,
                SUM(CASE WHEN d.billable_type = 1 THEN d.hrs ELSE 0 END) as billable,
                SUM(CASE WHEN d.billable_type = 0 THEN d.hrs ELSE 0 END) as non_billable,
                SUM(CASE WHEN d.billable_type = 2 THEN d.hrs ELSE 0 END) as internal
            ")
            ->whereBetween('d.created_at', [$startDate, $endDate])
            ->groupBy('d.user_id', 'u.name', 'u.department')
            ->get()
            // iterates over each employee object in the collection returned by the database query. For each employee ($item):
            ->map(function ($item) {  
                $total = $item->billable + $item->non_billable + $item->internal;
                $item->total = $total;
                $item->billable_percent = $total ? round(($item->billable / $total) * 100, 2) : 0;
                $item->non_billable_percent = $total ? round(($item->non_billable / $total) * 100, 2) : 0;
                $item->internal_percent = $total ? round(($item->internal / $total) * 100, 2) : 0;
                return $item;
            })
            // ->sortByDesc('non_billable'); // To disaply non billable emp at first
            ->sortByDesc('non_billable_percent'); // To display highest non-billable % first

    }
   
}
