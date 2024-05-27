<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AstrologerAvailability extends Model
{
    use HasFactory;
    protected $fillable = [
        'astrologerId',
        'fromTime',
        'toTime',
        'day'
    ];
}
