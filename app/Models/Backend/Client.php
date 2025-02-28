<?php


namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

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
}
