<?php

namespace App\Models\Backend;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'si_tasks';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    protected $appends = ['formatted_end_date']; // Append this attribute

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'project_id',
        'task_name',
        'task_category',
        'description',
        'end_date',
        'status',
        'assigned_to',
        'estimation_hrs',
        'created_by',
        'updated_by',
    ];

    public static $taskCategoryNames = [
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

     // Accessor to get the Category name
     public function gettaskCategoryNameAttribute()
     {
         return self::$taskCategoryNames[$this->task_category] ?? 'N/A';
     }

     // Default value for status
     protected $attributes = [
        'status' => 1,
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'end_date' => 'datetime', // Cast end_date to a DateTime object
        'estimation_hrs' => 'float', // Cast estimation_hrs to a float
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true; // Enable timestamps (created_at and updated_at)

    // To gain the relationship with project table for ex:project_name 
    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function getFormattedEndDateAttribute()
    {
        return Carbon::parse($this->end_date)->format('d F'); // Formats as "12 March"
    }

    
    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }


}
