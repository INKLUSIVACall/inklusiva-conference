<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Modules\Lag\Models\Meeting;
use App\Modules\Lag\Models\Recording;
use App\Notifications\AccountActivatedNotification;
use App\Notifications\EmailUpdatePinNotification;
use App\Notifications\RegistrationPendingNotification;
use App\Notifications\RegistrationPendingNotificationForTempUser;
use App\Notifications\SetPasswordNotification;
use App\Notifications\UserRegisteredNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Notifications\Notification;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class TempUser extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    const USER_OCCUPATION_PRIVATE = 'privat';

    const USER_OCCUPATION_ORGANISATION = 'organisation';

    protected $table = 'temp_users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'firstname',
        'lastname',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
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

    public function sendRegistrationPendingNotification($meeting)
    {
        $this->notify(new RegistrationPendingNotificationForTempUser($this, $meeting));
    }

    ////////////////////////////
    // Relationships
    ////////////////////////////

    public function meetings(): HasMany
    {
        return $this->hasMany(Meeting::class, 'tempCreator_id');
    }


}
