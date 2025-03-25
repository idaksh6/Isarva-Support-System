<?php


namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use HasFactory, SoftDeletes; // Include SoftDeletes trait;

    protected $table = 'isar_clients';

    protected $fillable = [
        'client_name',
        'company_name',
        'username',
        'password',
        'email',
        'phone',
        'description',
        'profile_image',
    ];

    protected $hidden = [
        'password',
    ];

    protected $dates = ['deleted_at']; // Add deleted_at column support
}
