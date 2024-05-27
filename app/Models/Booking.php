<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }
    public function astrologer()
    {
        return $this->belongsTo(Astrologer::class, 'astrologer_id');
    }
    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }
}
