<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Modules\Lag\Models\Meeting;
use App\Notifications\AccountActivatedNotification;
use App\Notifications\EmailUpdatePinNotification;
use App\Notifications\RegistrationPendingNotification;
use App\Notifications\SetPasswordNotification;
use App\Notifications\UserRegisteredNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Notifications\Notification;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, HasRoles, Notifiable;

    const USER_OCCUPATION_PRIVATE = 'privat';

    const USER_OCCUPATION_ORGANISATION = 'organisation';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'occupation',
        'organisation_name',
        'message',
        'firstname',
        'lastname',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function getFullName()
    {
        if ($this->firstname && $this->lastname) {
            return "{$this->firstname} {$this->lastname}";
        } elseif ($this->name) {
            return $this->name;
        } else {
            return '';
        }
    }

    public function getOccupation()
    {
        switch ($this->occupation) {
            case 'privat':
                return 'Privatperson';
                break;
            case 'organisation':
                return 'Organisator*in einer Selbsthilfegruppe';
                break;
            default:
                return '';
                break;
        }
    }

    public function sendRegistrationPendingNotification()
    {
        $this->notify(new RegistrationPendingNotification($this));
    }

    public function sendUserRegisteredNotification()
    {
        if (env('FILTER_4MORGEN_ADMINS', true)) {
            $adminUsers = User::role('admin')->where('email', 'not like', '%viermorgen%')->get();
        } else {
            $adminUsers = User::role('admin')->get();
        }
        foreach ($adminUsers as $adminUser) {
            $adminUser->notify(new UserRegisteredNotification($adminUser));
        }
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new SetPasswordNotification($token, $this));
    }

    public function sendAccountActivatedNotification($token)
    {
        $this->notify(new AccountActivatedNotification($token, $this));
    }

    public function sendEmailUpdatePinNotification($pin)
    {
        $this->notify(new EmailUpdatePinNotification($pin, $this));
    }

    public function routeNotificationForMail(Notification $notification)
    {
        // Return the new email address if the notification is an instance of EmailUpdatePinNotification.
        if (get_class($notification) === 'App\Notifications\EmailUpdatePinNotification') {
            return $this->new_email;
        }

        return $this->email;
    }

    /**
     * Checks for a new email address to inform the user on the Dashboard about it.
     */
    public function isProfileComplete()
    {
        if ($this->new_email) {
            return false;
        }

        return true;
    }

    ////////////////////////////
    // Relationships
    ////////////////////////////

    public function meetings(): HasMany
    {
        return $this->hasMany(Meeting::class, 'creator_id');
    }
}
