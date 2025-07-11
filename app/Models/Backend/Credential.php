<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Crypt;



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

    // public function setPasswordAttribute($value)
    // {
    //     $this->attributes['password'] = Hash::needsRehash($value) 
    //         ? Hash::make($value) 
    //         : $value;
    // }
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Crypt::encryptString($value);
    }

    // public function getPasswordAttribute($value)
    // {
    //     return Crypt::decryptString($value);
    // }
    public function getPasswordAttribute($value)
    {
        try {
            return $value ? Crypt::decryptString($value) : 'N/A';
        } catch (\Exception $e) {
            return 'Invalid/Corrupted';
        }
    }


       public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }


    public function getTypeTextAttribute()
   {
     $types = [
        1 => 'Server',
        2 => 'Application',
        3 => 'FTP',
        4 => 'Others'
    ];

    return $types[$this->type] ?? 'N/A';
    }

    public function getTypeBadgeClassAttribute()
    {
        $badgeColors = [
            1 => 'primary',    // Server
            2 => 'success',    // Application
            3 => 'warning',    // FTP
            4 => 'secondary'   // Others
        ];

        return $badgeColors[$this->type] ?? 'dark';
    }


}
