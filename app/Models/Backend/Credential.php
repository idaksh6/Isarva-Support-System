<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Hash;



class Credential extends Model
{
    use HasFactory, SoftDeletes; 

    protected $table = 'si_credentials';

    protected $fillable = [
        'user_id',
        'project_id',
        'title',
        'type',
        'username',
        'password',
        'description',
        'created_by',
        'updated_by',
    ];

     // Hide password from API/array output 
    protected $hidden = ['password'];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::needsRehash($value) 
            ? Hash::make($value) 
            : $value;
    }

       public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }


}
