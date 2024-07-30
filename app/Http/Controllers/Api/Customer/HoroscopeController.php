<?php

namespace App\Http\Controllers\Api\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\ZodiacSign;
use App\Models\DailyHoroscope;
use DB;
define('DATEFORMAT', "(DATE_FORMAT(horoscopeDate,'%Y-%m-%d'))");
class HoroscopeController extends Controller
{
    protected $assets_url;
    protected $default_image;

    public function __construct()
    {
      $this->assets_url = asset('images/horoscope');
      $this->default_image = asset('images/no-image.png');
    }
    public function today()
    {
        $dt = Carbon::now()->format('Y-m-d');
        $zodiacSigns = ZodiacSign::with(['dailyHoroscope' => function ($query) use ($dt) {
            $query->whereDate(DB::raw(DATEFORMAT), $dt);
        }])->where('status', 1)->orderBy('created_at', 'asc')->get();
        
        return response()->json(['zodiacSigns' => $zodiacSigns, 'dt' => $dt]);
    }

    public function yesterday()
    {
        $yesterday = Carbon::yesterday()->format('Y-m-d');
        $zodiacSigns = ZodiacSign::with(['dailyHoroscope' => function ($query) use ($yesterday) {
            $query->whereDate(DB::raw(DATEFORMAT), $yesterday);
        }])->where('status', 1)->orderBy('created_at', 'asc')->get();

        return response()->json(['zodiacSigns' => $zodiacSigns, 'yesterday' => $yesterday]);
    }

    public function tomorrow()
    {
        $tomorrow = Carbon::tomorrow()->format('Y-m-d');
        $zodiacSigns = ZodiacSign::with(['dailyHoroscope' => function ($query) use ($tomorrow) {
            $query->whereDate(DB::raw(DATEFORMAT), $tomorrow);
        }])->where('status', 1)->orderBy('created_at', 'asc')->get();

        return response()->json(['zodiacSigns' => $zodiacSigns, 'tomorrow' => $tomorrow]);
    }

    public function weekly()
    {
        $zodiacSigns = ZodiacSign::with(['horoscope' => function ($query) {
            $query->where('horoscopeType', 'Weekly');
        }])
        ->where('status', 1)
        ->orderBy('created_at', 'asc')
        ->get();

        return response()->json(['weekly' => $zodiacSigns]);
    }

    public function monthly()
    {
        $zodiacSigns = ZodiacSign::with(['horoscope' => function ($query) {
            $query->where('horoscopeType', 'Monthly');
        }])
        ->where('status', 1)
        ->orderBy('created_at', 'asc')
        ->get();

        return response()->json(['monthly' => $zodiacSigns]);
    }

    public function yearly()
    {
        $zodiacSigns = ZodiacSign::with(['horoscope' => function ($query) {
            $query->where('horoscopeType', 'Yearly');
        }])
        ->where('status', 1)
        ->orderBy('created_at', 'asc')
        ->get();

        return response()->json(['yearly' => $zodiacSigns]);
    }
    public function index()
    {
        $query = DB::table('zodiac_signs as zs')
            ->selectRaw("
                zs.id,
                zs.name,
                zs.date_from,
                zs.date_to,
                CASE
                    WHEN zs.image IS NULL OR zs.image = ''
                    THEN '$this->default_image'
                    ELSE CONCAT('$this->assets_url', '/', zs.image)
                END AS image_path
            ")
            ->where('zs.status', 1);

        $zodiacSigns = $query->get();

        if ($zodiacSigns->count() > 0) {
            return response()->json(['status' => 'success', 'message' => 'Record found', 'data' => $zodiacSigns]);
        } else {
            return response()->json(['status' => 'failure', 'message' => 'No data available', 'data' => []]);
        }
    }
    
}
