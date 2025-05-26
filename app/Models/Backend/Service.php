<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Service extends Model
{

    use SoftDeletes;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'services';

    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // protected $fillable = [
    //     'project_id',
    //     'service_type',
    //     'service_name',
    //     'provider',
    //     'expiry_date',
    //     'renewal_cost',
    //     'priority',
    //     'notes',
    //     'auto_renew'
    // ];

    protected $fillable = [
        'client_id',
        'project_id',
        'd_service',
        'd_name',
        'd_exp',
        'h_service',
        'h_ip',
        'h_exp',
        'a_service',
        'a_name',
        'a_exp',
        'provider',
        'renewal_cost',
        'priority',
        'notes',
        'auto_renew',
        'created_by', 
        'updated_by',
    ];
    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'expiry_date' => 'date',
        'auto_renew' => 'boolean',
    ];

    /**
     * Automatically set priority based on expiry date.
     */
    // public static function boot()
    // {
    //     parent::boot();

    //     static::saving(function ($service) {
    //         $daysLeft = now()->diffInDays($service->expiry_date, false);
            
    //         if ($daysLeft <= 5) {
    //             $service->priority = 'urgent';
    //         } elseif ($daysLeft <= 10) {
    //             $service->priority = 'upcoming';
    //         } else {
    //             $service->priority = 'normal';
    //         }
    //     });
    // }

    // public static function boot()
    // {
    //     parent::boot();

    //     static::saving(function ($service) {
    //         // Collect all active service expiry dates
    //         $expiryDates = [];
            
    //         if ($service->d_service && $service->d_exp) {
    //             $expiryDates[] = Carbon::parse($service->d_exp);
    //         }
    //         if ($service->h_service && $service->h_exp) {
    //             $expiryDates[] = Carbon::parse($service->h_exp);
    //         }
    //         if ($service->a_service && $service->a_exp) {
    //             $expiryDates[] = Carbon::parse($service->a_exp);
    //         }

    //         // If no active services, set to normal
    //         if (empty($expiryDates)) {
    //             $service->priority = 'normal';
    //             return;
    //         }

    //         // Find the earliest expiry date among active services
    //         $earliestExpiry = min($expiryDates);
    //         $daysLeft = now()->diffInDays($earliestExpiry, false);
            
    //         // Set priority based on the earliest expiring service
    //         if ($daysLeft <= 5) {
    //             $service->priority = 'urgent';
    //         } elseif ($daysLeft <= 10) {
    //             $service->priority = 'upcoming';
    //         } else {
    //             $service->priority = 'normal';
    //         }
    //     });
    // }

        public static function boot()
        {
            parent::boot();

            static::saving(function ($service) {
                // Reset to normal by default
                $service->priority = 'normal';
                
                // Calculate days left for each active service
                $priorities = [];
                
                if ($service->d_service && $service->d_exp) {
                    $daysLeft = now()->diffInDays(Carbon::parse($service->d_exp), false);
                    $priorities[] = self::determinePriority($daysLeft);
                }
                
                if ($service->h_service && $service->h_exp) {
                    $daysLeft = now()->diffInDays(Carbon::parse($service->h_exp), false);
                    $priorities[] = self::determinePriority($daysLeft);
                }
                
                if ($service->a_service && $service->a_exp) {
                    $daysLeft = now()->diffInDays(Carbon::parse($service->a_exp), false);
                    $priorities[] = self::determinePriority($daysLeft);
                }

                // Only update if we have active services
                if (!empty($priorities)) {
                    // Get the most urgent priority
                    if (in_array('urgent', $priorities)) {
                        $service->priority = 'urgent';
                    } elseif (in_array('upcoming', $priorities)) {
                        $service->priority = 'upcoming';
                    }
                    // Otherwise stays 'normal'
                }
                
                // \Log::info("Priority Calculation", [
                //     'd_exp' => $service->d_exp,
                //     'h_exp' => $service->h_exp,
                //     'a_exp' => $service->a_exp,
                //     'calculated_priority' => $service->priority,
                //     'all_priorities' => $priorities
                // ]);
            });
        }

        protected static function determinePriority($daysLeft)
        {
            if ($daysLeft <= 5) return 'urgent';
            if ($daysLeft <= 10) return 'upcoming';
            return 'normal';
        }

        public function domainPriority()
        {
            if (!$this->d_service || !$this->d_exp) return null;
            $daysLeft = now()->diffInDays(Carbon::parse($this->d_exp), false);
            return self::determinePriority($daysLeft);
        }

        public function hostingPriority()
        {
            if (!$this->h_service || !$this->h_exp) return null;
            $daysLeft = now()->diffInDays(Carbon::parse($this->h_exp), false);
            return self::determinePriority($daysLeft);
        }

        public function applicationPriority()
        {
            if (!$this->a_service || !$this->a_exp) return null;
            $daysLeft = now()->diffInDays(Carbon::parse($this->a_exp), false);
            return self::determinePriority($daysLeft);
        }

    /**
     * Scope to filter urgent renewals.
     */
    public function scopeUrgent($query)
    {
        return $query->where('priority', 'urgent');
    }

    /**
     * Scope to filter by project.
     */
    public function scopeForProject($query, $projectId)
    {
        return $query->where('project_id', $projectId);
    }

    // Used to fetch client name to display under table manage page
    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

}
