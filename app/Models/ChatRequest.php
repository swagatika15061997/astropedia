<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatRequest extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'astrologer_id','isFreeSession', 'status' // Add other necessary fields
    ];
    public function astrologer()
    {
        return $this->belongsTo(Astrologer::class, 'astrologer_id');
    }
    public function customer()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
