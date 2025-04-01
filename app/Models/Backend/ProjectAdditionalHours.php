<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectAdditionalHours extends Model
{
    use HasFactory;

    protected $table = 'si_projects_additional_hrs'; // Explicitly specify the table name

    protected $fillable = [
    
        'project_id',
        'description',
        'comments',
        'hrs',
        'date',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'date' => 'date:Y-m-d', // Explicitly format as Y-m-d for HTML date input
    ];
    // Relationships (if needed)
    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }
}
