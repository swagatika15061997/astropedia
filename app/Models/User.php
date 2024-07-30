<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
// use Laravel\Sanctum\HasApiTokens;
use Laravel\Passport\HasApiTokens;


class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_active',
        'phone',
        'otp',
        'otp_expires_at',
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
    public function cart()
    {
        return $this->hasMany(Cart::class);
    }
    public function schedullingNotifications()
    {
        return $this->hasMany(SchedullingNotification::class);
    }
    // protected static function booted()
    // {
    //     static::updated(function ($user) {
    //         Event::dispatch(new UserStatusUpdated($user->id, $user->is_online ? 'online' : 'offline'));
    //     });
    // }

    // public function setIsOnlineAttribute($value)
    // {
    //     $this->attributes['is_online'] = $value;
    //     $this->save();
    // }
}
