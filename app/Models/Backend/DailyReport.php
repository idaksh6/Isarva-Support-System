<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyReport extends Model
{
    use HasFactory;
    
    protected $table = 'si_daily_report';

    protected $fillable = [
        'user_id',
        'total_time',
        'overall_status',
        'created_by',
        'updated_by',
    ];

      // Relationship to User (si_users table)

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    // Relationship to DailyReportField
    public function fields() {
        return $this->hasMany(DailyReportField::class, 'daily_report_id');
    }
}
