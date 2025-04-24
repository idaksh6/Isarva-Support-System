<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyTask extends Model
{
    use HasFactory;

    protected $table = 'si_daily_tasks';

    protected $fillable = [
        'user_id',
        'type',
        'project_ticket_id',
        'project_ticket_name',
        'description',
        'notes',
        'status',
        'created_by',
        'updated_by',
    ];



    public function getStatusText(): string
    {
        switch ($this->status) {
            case 1:
                return 'Waiting for client';
            case 2:
                return 'Pending';
            case 3:
                return 'Client Review';
            case 4:
                return 'Progress';
            case 5:
                return 'Completed';
            case 6:
                return 'Review';
            case 7:
                return 'Not Started';
            default:
                return 'Unknown';
        }
    }
    
    public function getStatusBadgeAttribute(): string
    {
        $statusText = $this->getStatusText();
        $badgeClass = '';
    
        switch ($this->status) {
            case 1:
                $badgeClass = 'bg-warning text-dark'; // Waiting for client
                break;
            case 2:
                $badgeClass = 'bg-secondary'; // Pending
                break;
            case 3:
                $badgeClass = 'bg-info text-dark'; // Client Review
                break;
            case 4:
                $badgeClass = 'bg-primary'; // Progress
                break;
            case 5:
                $badgeClass = 'bg-success'; // Completed
                break;
            case 6:
                // $badgeClass = 'bg-light text-dark'; // Review
                $badgeClass = 'bg-pink text-dark';

                break;
            case 7:
                $badgeClass = 'bg-danger'; // Not Started
                break;
            default:
                $badgeClass = 'bg-dark'; // Unknown
                break;
        }
    
        return '<span class="badge ' . $badgeClass . '">' . $statusText . '</span>';
    }
    

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


        // In DailyTask.php
    public function subtasks()
    {
        return $this->hasMany(DailyTask::class); // or your related model
    }



}