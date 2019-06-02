<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\ResetPassword as changePasswordNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Jobs\SendPasswordResetEmailJob;
use App\Notifications\VerifyEmail as VerifyEmailNotification;
use App\Jobs\SendVerifyEmailJob;

/**
 * @property string email
 * @property string username
 * @property int role_id
 * @property string login_provider
 * @property mixed id
 */
class User extends Authenticatable implements  MustVerifyEmail {
    
    use Notifiable;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password', 'role_id',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Get the user profile record associated with the user.
     */
    public function userProfile() {
        return $this->hasOne('App\Models\UserProfile');
    }
    
    /**
     * Get the employment history record associated with the user.
     */
    public function employmentHistories() {
        return $this->hasMany('App\Models\EmploymentHistory');
    }
    
    /**
     * Get the education record associated with the user.
     */
    public function educations() {
        return $this->hasMany('App\Models\Education');
    }
      
    /**
     * Get the skill record associated with the user.
     */
    public function skills() {
        return $this->hasMany('App\Models\UserSkill');
    }
    
    /**
     * Get the themes record associated with the user.
     */
    public function themes() {
        return $this->hasMany('App\Models\Theme');
    }
    
    public function role() {
        return $this->belongsTo(Role::class);
    }
    
    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token) {
        dispatch(new SendPasswordResetEmailJob(new changePasswordNotification($token, $this), $this->email));
    }

    public function sendEmailVerificationNotification() {
        dispatch(new SendVerifyEmailJob(new VerifyEmailNotification($this), $this->email));
    }

    public function isAdmin() {
        if (user()->role) {
            return (user()->role->slug === 'admin');
        }
        
        return false;
    }
}