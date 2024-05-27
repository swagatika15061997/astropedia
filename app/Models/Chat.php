<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;
    protected $casts = [
        'user_id' => 'integer',
        'status' => 'integer',
        'astrologer_id' => 'integer',
        'sent_by_customer' => 'integer',
        'sent_by_strologer' => 'integer',
        'seen_by_customer' => 'integer',
        'seen_by_strologer' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function customer()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function astrologer()
    {
        return $this->belongsTo(Astrologer::class, 'astrologer_id');
    }
}
