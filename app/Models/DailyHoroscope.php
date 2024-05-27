<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyHoroscope extends Model
{
    use HasFactory;
    public function zodiacSign()
    {
        return $this->belongsTo(ZodiacSign::class, 'zodiac_sign_id');
    }
}
