<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $table = 'isar_tickets';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'client',
        'title',
        'domain',
        'type',
        'source',
        'priority',
        'project',
        'description',
        'privacy',
        'assigned_to',
        'due_date',
        'department',
        'attachment',
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

   
    public static function countOpenTickets()
    {
        return self::where('status', 1)->count();
    }

    public static function countOnHoldTickets()
    {
        return self::where('status', 3)->count();
    }

    public static function countFlaggedTickets()
    {
        return self::whereNotNull('flag_to')->where('flag_to', '!=', '')->count();
    }

    public static function getActiveTicketCount()
    {
        return self::where('status', '!=', 7)->count();
    }
    
}