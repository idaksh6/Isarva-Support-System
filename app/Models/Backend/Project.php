<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon; // Import Carbon for date manipulation
use App\Models\Backend\ProjectEstimationChangeLog;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory, SoftDeletes; // Add SoftDeletes here;

    protected $table = 'si_projects';

    protected $fillable = [
        'client',
        'project_name',
        'category',
        'project_image',
        'manager',
        'team_leader',
        'team_members',
        'start_date',
        'end_date',
        'department',
        'status',
        'budget',
        'priority',
        'type',
        'estimation',
        'biiling_company', 
        'description',
        'change_estimation',
        'change_estimation_reason',
        'created_by',
        'updated_by'
    ];

    public static $categoryNames = [
        1 => 'Website Designing',
        2 => 'App Development',
        3 => 'Quality Assurance',
        4 => 'Development',
        5 => 'Backend Development',
        6 => 'Software Testing',
        7 => 'Marketing ',
        8 => 'UI/UX Designing',
        9 => 'Others',
        
    ];


    public static $priorityLabels = [
        1 => 'Low',
        2 => 'Medium',
        3 => 'High',
    ];

    public static $departmentLabels = [
        1 => 'Web Application',
        2 => 'Website',
        3 => 'Graphics',
    ];

    public function getStatusClass()
    {
        $statusClasses = [
            1 => 'primary',  // Onboard
            2 => 'info',     // Open
            3 => 'warning',  // Progress
            4 => 'secondary', // Monitor
            5 => 'success',   // Billing
            6 => 'danger',  // Closed
            7 => 'dark',     // On Hold
            8 => 'dark',    // Warranty
        ];

        return $statusClasses[$this->status] ?? 'secondary';
    }

    public function getStatusText()
    {
        $statusText = [
            1 => 'Onboard',
            2 => 'Open',
            3 => 'Progress',
            4 => 'Monitor',
            5 => 'Billing',
            6 => 'Closed',
            7 => 'On Hold',
            8 => 'Warranty',
        ];

        return $statusText[$this->status] ?? 'Unknown';
    }


    public static $statusNames = [
        1 => 'Onboard',
        2 => 'Open',
        3 => 'Progress',
        4 => 'Monitor',
        5 => 'Billing',
        6 => 'Closed',
        7 => 'On Hold',
        8 => 'Warranty',
        9 => 'Waiting For Client Response'
    ];

    public static $priorityNames = [
        1 => 'Low',
        2 => 'Medium',
        3 => 'High',
    ];

    public static $departmentNames = [
        1 => 'Web Application',
        2 => 'Website',
        3 => 'Graphics',
    ];



    // For displaying the companie name in table view
    public static $billingCompanyNames = [
        0 => 'None',
        1 => 'Isarva Internal',
        2 => 'Blue flemingo',
        3 => 'Glue',
        4 => 'Eye Web',
        5 => 'Indian Project',
    ];

    public function getBillingCompanyNameAttribute()
    {
        return self::$billingCompanyNames[$this->biiling_company] ?? 'Unknown';
    }


    public function getStatusNameAttribute()
    {
        return self::$statusNames[$this->status] ?? 'N/A';
    }

    public function getPriorityNameAttribute()
    {
        return self::$priorityNames[$this->priority] ?? 'N/A';
    }

    // Defining relation to fetch manager name 
    public function managerUser()
    {
        return $this->belongsTo(User::class, 'manager');
    }


    public function getDepartmentNameAttribute()
    {
        return self::$departmentNames[$this->department] ?? 'N/A';
    }

    public function getClientNameAttribute()
    {
        return optional($this->belongsTo(Client::class, 'client')->first())->client_name ?? 'N/A';
    }
    
    
    
    // Used under Project manage page 
    public function getManagerNameAttribute()
    {
        return $this->belongsTo(User::class, 'manager')->value('name') ?? 'N/A';
    }

    public function getFormattedStartDateAttribute()
    {
        return Carbon::parse($this->start_date)->format('d M Y');
    }

    public function getStatusLabelAttribute()
    {
        return self::$statusLabels[$this->status] ?? 'Unknown';
    }

    public function getPriorityLabelAttribute()
    {
        return self::$priorityLabels[$this->priority] ?? 'Unknown';
    }

    public function getDepartmentLabelAttribute()
    {
        return self::$departmentLabels[$this->department] ?? 'Unknown';
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'client', 'id');
    }

    // Accessor to get the Category name
    public function getCategoryNameAttribute()
    {
        return self::$categoryNames[$this->category] ?? 'N/A';
    }

     // Relationship to fetch the user who updated the project
     public function updatedBy()
     {
         return $this->belongsTo(User::class, 'updated_by');
     }

      // Relationship to fetch estimation change logs
    public function estimationChangeLogs()
    {
        return $this->hasMany(ProjectEstimationChangeLog::class, 'project_id');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class, 'project_id');
    }

    // In your Project model (app/Models/Project.php)
    public function additionalHours()
    {
        return $this->hasMany(ProjectAdditionalHours::class);
    }

    

    // Accessor to calculate the project duration
    public function getProjectDurationAttribute()
    {
        $startDate = Carbon::parse($this->start_date);
        $endDate = Carbon::parse($this->end_date);

        // Calculate the difference in months
        $monthsDifference = $startDate->diffInMonths($endDate);

        // If the difference is less than 1 month, calculate the difference in days
        if ($monthsDifference < 1) {
            $daysDifference = $startDate->diffInDays($endDate);
            return $daysDifference . ' Days';
        }

        return $monthsDifference . ' Month' . ($monthsDifference > 1 ? 's' : '');
    }

   // Accessor to count the number of team members and handle singular/plural
        public function getTeamMembersCountAttribute()
        {
            // Check if team_members is not empty
            if (!empty($this->team_members)) {
                // Split the comma-separated string into an array
                $teamMembersArray = explode(',', $this->team_members);
                // Count the number of elements in the array
                $count = count($teamMembersArray);
                // Handle singular/plural
                return $count . ($count === 1 ? ' Member' : ' Members');
            }

            // If team_members is empty, return "0 Members"
            return '0 Members';
        }

        
    // Accessor to calculate the days left or deadline status
    public function getDaysLeftAttribute()
    {
        $startDate = Carbon::parse($this->start_date);
        $endDate = Carbon::parse($this->end_date);
        $currentDate = Carbon::now();

        // Case 1: If the current date is before the start date
        if ($currentDate->lt($startDate)) {
            $daysLeft = $startDate->diffInDays($endDate);
            return $daysLeft . ' Days Left';
        }

        // Case 2: If the current date is after the end date
        if ($currentDate->gt($endDate)) {
            return '<span class="text-danger">Project met its deadline</span>';
        }

        // Case 3: If the current date is between the start and end date
        $daysLeft = $currentDate->diffInDays($endDate);
        return $daysLeft . ' Days Left';
    }

    // Get total project count
    public static function getTotalProjects()
    {
        return self::count();  
    }

    public static function getOpenProjectCount()
    {
        return self::where('status', 2)->count();
    }

    public static function getClosedProjectCount()
    {
        return self::where('status', 6)->count();
    }

    
    public static function getOnHoldProjectCount()
    {
        return self::where('status', 7)->count();
    }




    // public function client()
    // {
    //     return $this->belongsTo(Client::class, 'client', 'id');
    // }


    
    public function getProgressAttribute()
    {
        $startDate = Carbon::parse($this->start_date);
        $endDate = Carbon::parse($this->end_date);
        $today = Carbon::now();

        if ($today->lt($startDate)) {
            return 0; // Not started
        } elseif ($today->gt($endDate)) {
            return 100; // Completed
        } else {
            $totalDuration = $endDate->diffInDays($startDate);
            $elapsedDuration = $today->diffInDays($startDate);
            return ($elapsedDuration / $totalDuration) * 100;
        }
    }

    /**
     * Check if the project is overdue.
     *
     * @return bool
     */
    public function getIsOverdueAttribute()
    {
        $endDate = Carbon::parse($this->end_date);
        $today = Carbon::now();
        return $today->gt($endDate);
    }

    /**
     * Get the formatted date range (e.g., "Feb 18 - Mar 28").
     *
     * @return string
     */
    public function getFormattedDateRangeAttribute()
    {
        $startDate = Carbon::parse($this->start_date);
        $endDate = Carbon::parse($this->end_date);
        return $startDate->format('M d') . ' - ' . $endDate->format('M d');
    }

    /**
     * Get the days left text (e.g., "5 days left" or "Exceeded by 2 days").
     *
     * @return string
     */
    // public function getDaysLeftTextAttribute()
    // {
    //     $startDate = Carbon::parse($this->start_date);
    //     $endDate = Carbon::parse($this->end_date);
    //     $today = Carbon::now();

    //     if ($today->lt($startDate)) {
    //         return 'Not Started';
    //     } elseif ($today->gt($endDate)) {
    //         $daysExceeded = $today->diffInDays($endDate);
    //         // return 'Exceeded by ' . $daysExceeded . ' day' . ($daysExceeded > 1 ? 's' : '');
    //         return  $daysExceeded . ' Days' . ' After Due';
    //     } else {
    //         $daysLeft = $today->diffInDays($endDate);
    //         return $daysLeft . ' day' . ($daysLeft > 1 ? 's' : '') . ' left';
    //     }
    // }
    public function getDaysLeftTextAttribute()
    {
        $startDate = Carbon::parse($this->start_date);
        $endDate = Carbon::parse($this->end_date);
        $today = Carbon::now();
    
        // If the project hasn't started yet
        if ($today->lt($startDate)) {
            return 'Not Started';
        }
    
        // If project is Closed (6) or On Hold (7)
        if (in_array($this->status, [6, 7])) {
            return 'Completed';
        }
    
        // If current date is after deadline but project is NOT closed/on hold
        if ($today->gt($endDate)) {
            $daysExceeded = $today->diffInDays($endDate);
            return $daysExceeded . ' day' . ($daysExceeded > 1 ? 's' : '') . ' After Due';
        }
    
        // If still within duration and active
        $daysLeft = $today->diffInDays($endDate);
        return $daysLeft . ' day' . ($daysLeft > 1 ? 's' : '') . ' left';
    }
    

   
    

    /**
     * Get the color for the days left section.
     *
     * @return string
     */
    // public function getDaysLeftColorAttribute()
    // {
    //     $startDate = Carbon::parse($this->start_date);
    //     $endDate = Carbon::parse($this->end_date);
    //     $today = Carbon::now();

    //     if ($today->lt($startDate)) {
    //         return 'orange'; // Not Started
    //     } elseif ($today->gt($endDate)) {
    //         return 'brown'; // Exceeded
    //     } else {
    //         return 'green'; // Days Left
    //     }
    // }

    public function getDaysLeftColorAttribute()
    {
        $startDate = Carbon::parse($this->start_date);
        $endDate = Carbon::parse($this->end_date);
        $today = Carbon::now();
    
        // Completed or On Hold
        if (in_array($this->status, [6, 7])) {
            return 'gray'; // You can change to 'green' if you prefer
        }
    
        // Not started yet
        if ($today->lt($startDate)) {
            return 'orange';
        }
    
        // Exceeded deadline (but not completed)
        if ($today->gt($endDate)) {
            return 'brown';
        }
    
        // Active and within duration
        return 'green';
    }
    
    
    
   
    

    public static function getMonthsList()
    {
        return [
            '1' => 'January',
            '2' => 'February',
            '3' => 'March',
            '4' => 'April',
            '5' => 'May',
            '6' => 'June',
            '7' => 'July',
            '8' => 'August',
            '9' => 'September',
            '10' => 'October',
            '11' => 'November',
            '12' => 'December'
        ];
    }
    
    public static function getYearsList($startYear = 2020)
    {
        $currentYear = date('Y');
        $years = [];
        
        for ($year = $currentYear; $year >= $startYear; $year--) {
            $years[$year] = $year;
        }
        
        return $years;
    }


}
