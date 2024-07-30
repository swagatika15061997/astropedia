<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Events\AstrologerStatusEvent;
use Illuminate\Support\Facades\Event;

class Astrologer extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guard='astrologer';
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_active',
        'is_online',
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
    public function availability()
    {
        return $this->hasMany(AstrologerAvailability::class);
    }
    public function skillss()
    {
        return $this->belongsTo(Skill::class,'skill');
    }
    // protected static function booted()
    // {
    //     static::updated(function ($astrologer) {
    //         if ($astrologer->isDirty('is_online')) {
    //             Event::dispatch(new AstrologerStatusEvent($astrologer->id, $astrologer->is_online ? 'online' : 'offline'));
    //         }
    //     });
    // }

    // public function setIsOnlineAttribute($value)
    // {
    //     $this->attributes['is_online'] = $value;
    //     $this->save();
    // }
    
    
}
