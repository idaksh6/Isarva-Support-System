<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;



class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'password',


        'profile_image',
        'employee_id',
        'joining_date',
        'user_name',

        // 'email_id',
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

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
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



    // Relationships for projects where user is manager
    public function managedProjects()
    {
        return $this->hasMany(Project::class, 'manager');
    }

    // Relationship for projects where user is a team member
    public function teamMemberProjects()
    {
        return Project::whereRaw("FIND_IN_SET(?, team_members)", [$this->id]);
    }

    // Combined relationship for all projects (manager + team member)
    public function accessibleProjects()
    {
        return Project::where('manager', $this->id)
            ->orWhereRaw("FIND_IN_SET(?, team_members)", [$this->id]);
    }

    // Relationship for assigned tasks
    public function assignedTasks()
    {
        return $this->hasMany(Task::class, 'assigned_to');
    }
    public function updateLastActivity()
    {
        $this->last_activity_at = now();
        $this->save();
    }
}
