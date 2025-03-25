<?php

namespace App\Models\Backend;

use Illuminate\Foundation\Auth\User as Authenticatable; // <-- Change this
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Employee extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'si_users';

    protected $fillable = [
        'name',
        'profile_image',
        'employee_id',
        'joining_date',
        'user_name',
        'password',
        'email_id',
        'phone',
        'webhook_url',
        'department',
        'designation',
        'status',
        'role',
        'address',
        'is_salaried',
        'is_marketing_person',
        'access_all_tickets',
        'report_required',
        'description',
        'created_by',
        'updated_by'
    ];

     // Define the designation mapping
     public static $designationNames = [
        1 => 'Website Desiginer',
        2 => 'App Development',
        3 => 'UI/UX Designer',
        4 => 'HR Manager',
        5 => 'Backend Development',
        6 => 'Software Testing',
        7 => 'Marketing Analyst',
        8 => 'Quality Assurance',
        9 => 'Others',
        
    ];

    // Accessor to get the designation name
    public function getDesignationNameAttribute()
    {
        return self::$designationNames[$this->designation] ?? 'N/A';
    }

    public function permissions()
    {
        // return $this->belongsToMany(Permission::class, 'employee_permission')
        //             ->withPivot('page_id');
    }

    protected $hidden = [
        'password',
    ];

    // public function getIsSuperAdminAttribute() {
    //     return $this->role === 'super_admin'; // Replace 'role' with the actual column name
    //     // return $this->type === 'admin';
    // }
    public function getAuthIdentifierName()
    {
        return 'email_id';  // Change from 'email' to 'email_id'
    }

    public function getAuthIdentifier()
    {
        return $this->email_id; 
    }
    
}

