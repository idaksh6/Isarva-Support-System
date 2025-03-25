<?php

namespace App\Models\Backend;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketComment extends Model
{
    use HasFactory;

    protected $table = 'isar_ticket_discusion';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'ticket_id',
        'comments',
        'attahcement', // Note: Matches the column name with typo from your table
        'created_on',
        'last_modified_on',
        'comment_type',
        'is_client_reply',
        'ip_address',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'created_on' => 'datetime',
        'last_modified_on' => 'datetime',
    ];

    /**
     * Relationships
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    /**
     * Accessors
     */
    public function getAttachmentAttribute()
    {
        return $this->attahcement ? asset("storage/{$this->attahcement}") : null;
    }
}