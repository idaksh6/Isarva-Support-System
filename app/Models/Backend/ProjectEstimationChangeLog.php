<?php

namespace App\Models\Backend;

use App\Models\Backend\Employee;
use App\Models\Backend\Project;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectEstimationChangeLog extends Model
{
    use HasFactory;

    protected $table = 'project_estimation_change_log';

    protected $fillable = [
        'project_id',
        'change_req_by',
        'changed_by',
        'reason',
        'changed_from',
        'changed_to',
        'diff',
        'approval_status',
        'change_approved_by',
        'change_rejected_by',
        'reason_for_rejection',
        'manager_notify_status',
        'requester_notify_status',
        'created_by',
        'updated_by',
    ];

    /**
     * Relationships
     */

  
    // A change log belongs to a project
    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }


    // A change log belongs to a user who changed it
    public function changedBy()
    {
        return $this->belongsTo(User::class, 'changed_by');
    }

    // A change log may have a requester
    public function changeRequester()
    {
        return $this->belongsTo(User::class, 'change_req_by');
    }

    // A change log may have an approver
    public function changeApprovedBy()
    {
        return $this->belongsTo(User::class, 'change_approved_by');
    }

    // A change log may have a rejecter
    public function changeRejectedBy()
    {
        return $this->belongsTo(User::class, 'change_rejected_by');
    }

    // A change log is created by a user
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // A change log is updated by a user
    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
    public function createdByUser()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedByUser()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
