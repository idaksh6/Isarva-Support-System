<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Backup extends Model
{
    protected $table = 'si_backups';

    protected $fillable = [
        'group_id',
        'project_ticket',
        'project_ticket_id',
        'domain',
        'present_ip',
        'last_backup_file_name',
        'last_backup_date',
        'last_backup_location',
        'backup_type',
        'wordpress_version',
        'php_version',
        'site_status',
        'framework_version',
        'drive_link',
        'description',
    ];



    public function getBackupTypeNameAttribute()
    {
        $types = [
            1 => 'Website Code',
            2 => 'Application Code',
            3 => 'Website and App Code',
            4 => 'Database File',
            5 => 'Website Code + DB File',
            6 => 'App Code + DB File',
            7 => 'Website Code + App Code + DB Files',
            8 => 'Graphics File',
        ];

        return $types[$this->backup_type] ?? 'N/A';
    }

    // protected static function boot()
    // {
    //     parent::boot();
    
    //     static::creating(function ($backup) {
    //         if ($backup->project_ticket == 1) { // Project
    //             if (empty($backup->project_ticket_id)) {
    //                 throw new \Exception("Project ID is required for project backups");
    //             }
    //             $backup->group_id = 'P_' . $backup->project_ticket_id;
    //         } elseif ($backup->project_ticket == 2) { // Ticket
    //             if (empty($backup->project_ticket_id)) {
    //                 throw new \Exception("Ticket ID is required for ticket backups");
    //             }
    //             $backup->group_id = 'T_' . $backup->project_ticket_id;
    //         } else { // Others (type=3 or null)
    //             if (empty($backup->domain)) {
    //                 throw new \Exception("Domain is required for other backups");
    //             }
    //             $backup->group_id = 'D_' . strtolower($backup->domain);
    //         }
    //     });
    // }
    // protected static function boot()
    // {
    //     parent::boot();

    //     static::creating(function ($backup) {
    //         if ($backup->project_ticket == 1) { // Project
    //             $backup->group_id = 'P_' . $backup->project_ticket_id;
    //         } 
    //         elseif ($backup->project_ticket == 2) { // Ticket
    //             $backup->group_id = 'T_' . $backup->project_ticket_id;
    //         } 
    //         else { // Domain (type=3)
    //             // Get the next available domain ID
    //             $maxDomainId = Backup::max('domain_id') ?? 0;
    //             $backup->domain_id = $maxDomainId + 1;
    //             $backup->group_id = 'D_' . $backup->domain_id;
    //         }
    //     });

    //     static::updating(function ($backup) {
    //         if ($backup->isDirty('domain') && $backup->project_ticket == 3) {
    //             // If domain changed, get a new domain_id
    //             $maxDomainId = Backup::max('domain_id') ?? 0;
    //             $backup->domain_id = $maxDomainId + 1;
    //             $backup->group_id = 'D_' . $backup->domain_id;
    //         }
    //     });
    // }


    // boot() method in your Backup model that defines automatic behaviors that should happen:
    // define custom logic that should be executed at specific points in the model's lifecycle 
    // protected static function boot()
    // {
    //     parent::boot();

    //     // It uses Laravel's model events (creating and updating) to automatically set:
    //     static::creating(function ($backup) {          // creating Event (New Records)
    //         if ($backup->project_ticket == 1) { // Project
    //             $backup->group_id = 'P_' . $backup->project_ticket_id;
    //         } 
    //         elseif ($backup->project_ticket == 2) { // Ticket
    //             $backup->group_id = 'T_' . $backup->project_ticket_id;
    //         } 
    //         else { // Domain (type=3)
    //             // Find if this domain already exists
    //             $existing = Backup::where('domain', strtolower($backup->domain))->first();
                
    //             if ($existing) {
    //                 // Use existing domain_id and group_id
    //                 $backup->domain_id = $existing->domain_id;
    //                 $backup->group_id = 'D_' . $existing->domain_id;
    //             } else {
    //                 // Create new domain_id
    //                 $maxDomainId = Backup::max('domain_id') ?? 0;
    //                 $backup->domain_id = $maxDomainId + 1;
    //                 $backup->group_id = 'D_' . $backup->domain_id;
    //             }
    //         }
    //     });
    
    //     static::updating(function ($backup) {
    //         if ($backup->project_ticket == 3 && $backup->isDirty('domain')) {  //isDirty : Checks if the domain field was modified during an update.
    //             // If domain changed, find if new domain exists
    //             $existing = Backup::where('domain', strtolower($backup->domain))->first();
                
    //             if ($existing) {
    //                 // Use existing domain_id and group_id
    //                 $backup->domain_id = $existing->domain_id;
    //                 $backup->group_id = 'D_' . $existing->domain_id;
    //             } else {
    //                 // Create new domain_id
    //                 $maxDomainId = Backup::max('domain_id') ?? 0;
    //                 $backup->domain_id = $maxDomainId + 1;
    //                 $backup->group_id = 'D_' . $backup->domain_id;
    //             }
    //         }
    //     });
    // }
}
