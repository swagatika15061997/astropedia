<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZodiacSign extends Model
{
    use HasFactory;
    public function dailyHoroscope()
    {
        return $this->hasOne(DailyHoroscope::class);
    }
    public function horoscope()
    {
        return $this->hasOne(Horoscope::class);
    }
}
