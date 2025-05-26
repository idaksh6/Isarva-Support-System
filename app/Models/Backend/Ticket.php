<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'isar_tickets';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        // 'client',
        // 'title',
        // 'domain',
        // 'type',
        // 'source',
        // 'priority',
        // 'client_name',
        // 'last_modified_on',

        // 'team_members',

        // 'project',
        // 'description',
        // 'privacy',
        // 'assigned_to',
        // 'due_date',
        // 'department',
        // 'attachment',
        // 'created_by',
        // 'updated_by',
        
        'client',

        'title',

        'domain',

        'type',

        'source',

        'priority',

        'team_members',

        'last_modified_on',

        'flag_to',

        'status',

        'project',

        'description',

        'privacy',

        'assigned_to',

        'due_date',

        'department',

        'email_id',

        'phone_number',

        'end_date',

        'last_updated_by',

        'is_client',
        
        'created_on',

        'attachment',

        'email_cc_list',

        'start_date',

        'comments',

        'client_name',

        'ip_address',

        'created_by',

        'updated_by',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'due_date' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    //     'team_members' => 'array',
     ];

 


    /**
     * Get the user who created the ticket.
     */
    public function createdBy()
    {
        return $this->belongsTo(Employee::class, 'created_by');
    }

    /**
     * Get the user who last updated the ticket.
     */
    public function updatedBy()
    {
        return $this->belongsTo(Employee::class, 'updated_by');
    }
    /**
     * Get all comments for the ticket
     */
    public function comments()
    {
        return $this->hasMany(TicketComment::class, 'ticket_id');
    }

   
    public static function countOpenTickets($userId = null)
    {
        $query = self::where('status', 1);
        if ($userId) {
            $query->where('flag_to', $userId);
        }
        return $query->count();
    }
    
    public static function countOnHoldTickets($userId = null)
    {
        $query = self::where('status', 3);
        if ($userId) {
            $query->where('flag_to', $userId);
        }
        return $query->count();
    }
    
    public static function countFlaggedTickets($userId = null)
    {
        $query = self::whereNotNull('flag_to')->where('flag_to', '!=', '');
        if ($userId) {
            $query->where('flag_to', $userId);
        }
        return $query->count();
    }
    
    public static function getActiveTicketCount($userId = null)
    {
        $query = self::where('status', '!=', 7);
        if ($userId) {
            $query->where('flag_to', $userId);
        }
        return $query->count();
    }

     public static function countClosedTickets($userId = null)

    {

        $query = self::where('status', 7);

        if ($userId) {

            $query->where('flag_to', $userId);

        }

        return $query->count();

    }

  /**
     * Scope for tickets accessible by a user
     */
    // public function scopeForUser($query, $userId, $isAdmin)
    // {
    //     if ($isAdmin) return $query;

    //     return $query->where(function($q) use ($userId) {
    //         $q->where('assigned_to', $userId)
    //           ->orWhere('flag_to', $userId)
    //           ->orWhere('team_members', 'like', "%,{$userId},%")
    //           ->orWhere('team_members', 'like', "{$userId},%")
    //           ->orWhere('team_members', 'like', "%,{$userId}")
    //           ->orWhere('team_members', $userId);
    //     });
    // }

    // /**
    //  * Scope for tickets by status
    //  */
    // public function scopeWithStatus($query, $status)
    // {
    //     return $query->where('status', $status);
    // }

    // /**
    //  * Get counts for all ticket statuses
    //  */
    // public static function getTicketCounts($userId, $isAdmin)
    // {
    //     $baseQuery = self::forUser($userId, $isAdmin);

    //     return [
    //         'total'    => $baseQuery->count(),
    //         'open'     => $baseQuery->clone()->withStatus(1)->count(),
    //         'progress' => $baseQuery->clone()->withStatus(2)->count(),
    //         'on_hold'  => $baseQuery->clone()->withStatus(3)->count(),
    //         'closed'   => $baseQuery->clone()->withStatus(4)->count(),
    //     ];
    // }
}