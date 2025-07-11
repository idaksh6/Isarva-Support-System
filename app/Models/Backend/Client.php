<?php


namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Foundation\Auth\User as Authenticatable;

// use App\Notifications\ClientResetPasswordNotification;
// use Illuminate\Auth\Passwords\CanResetPassword;
// use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
// use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\CanResetPassword; // Correct interface
use Illuminate\Auth\Passwords\CanResetPassword as CanResetPasswordTrait; // Rename trait
use Illuminate\Notifications\Notifiable;


// class Client extends Model

// class Client extends Model implements CanResetPassword
class Client extends Authenticatable
{
    use HasFactory, SoftDeletes,  Notifiable, CanResetPasswordTrait; // Include SoftDeletes trait;

    protected $table = 'isar_clients';

    protected $fillable = [
        'client_name',
        'company_name',
        // 'username',
        'user_name',
        'password',
        // 'email',
        'email_id',
        'phone',
        'description',
        'profile_image',
        'created_by',
        'updated_by',
    ];

    protected $hidden = [
        'password',
    ];

    protected $dates = ['deleted_at']; // Add deleted_at column support


    // public function getEmailForPasswordReset()
    // {
    //     return $this->email_id; // use correct DB column
    // }

    // public function sendPasswordResetNotification($token)
    // {
    //     $this->notify(new ClientResetPasswordNotification($token));
    // }

      /**
     * Get the email address for password reset.
     */
    public function getEmailForPasswordReset()
    {
        return $this->email_id; // Use  custom email field
    }

    /**
     * Send password reset notification.
     */
    // public function sendPasswordResetNotification($token)
    // {
    //     $this->notify(new ClientResetPasswordNotification($token));
    // }

}
