<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectInternalDocument extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'si_project_internal_documents';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'project_id',
        'date',
        'title',
        'link',
        'comments',
        'raw_index',
        'created_by',
        'updated_by',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'date' => 'date', // Cast 'date' to a Carbon instance
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true; // Enable timestamps (created_at and updated_at)

    /**
     * Get the project that owns the document.
     */
    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    /**
     * Get the user who created the document.
     */
    public function createdByUser()
    {
        return $this->belongsTo(Employee::class, 'created_by');
    }

    /**
     * Get the user who last updated the document.
     */
    public function updatedByUser()
    {
        return $this->belongsTo(Employee::class, 'updated_by');
    }
}
