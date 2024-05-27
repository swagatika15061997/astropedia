<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\ZodiacSign;
use App\Models\DailyHoroscope;
use Illuminate\Http\Request;
use DB;
define('DATEFORMAT', "(DATE_FORMAT(horoscopeDate,'%Y-%m-%d'))");
class HoroScopeController extends Controller
{
    public function today()
    {
        $dt = Carbon::now()->format('Y-m-d');
        $yesterday = Carbon::yesterday()->format('Y-m-d');
        $tomorrow = Carbon::tomorrow()->format('Y-m-d');
        $zodiacSigns = ZodiacSign::with(['dailyHoroscope' => function ($query) use ($dt) {
            $query->whereDate(DB::raw(DATEFORMAT), $dt);
        }])->where('status', 1)->orderBy('created_at', 'asc')->get();
        return view('today-horoscope',compact('zodiacSigns','dt'));
    }
    public function yesterday()
    {
        $yesterday = Carbon::yesterday()->format('Y-m-d');
        $zodiacSigns = ZodiacSign::with(['dailyHoroscope' => function ($query) use ($yesterday) {
            $query->whereDate(DB::raw(DATEFORMAT), $yesterday);
        }])->where('status', 1)->orderBy('created_at', 'asc')->get();
        return view('yesterday-horoscope',compact('zodiacSigns','yesterday'));
    }
    public function tomorrow()
    {
        $tomorrow = Carbon::tomorrow()->format('Y-m-d');
        $zodiacSigns = ZodiacSign::with(['dailyHoroscope' => function ($query) use ($tomorrow) {
            $query->whereDate(DB::raw(DATEFORMAT), $tomorrow);
        }])->where('status', 1)->orderBy('created_at', 'asc')->get();
        return view('tomorrow-horoscope',compact('zodiacSigns'));
    }
    public function weekly()
    {
        $zodiacSigns = ZodiacSign::with(['horoscope' => function ($query) {
            $query->where('horoscopeType', 'Weekly');
        }])
        ->where('status', 1)
        ->orderBy('created_at', 'asc')
        ->get();
        $horoscopeType = 'Weekly';
        return view('weekly-horoscope',compact('zodiacSigns','horoscopeType'));
    }
    public function monthly()
    {
        $zodiacSigns = ZodiacSign::with(['horoscope' => function ($query) {
            $query->where('horoscopeType', 'Monthly');
        }])
        ->where('status', 1)
        ->orderBy('created_at', 'asc')
        ->get();
        $horoscopeType = 'Monthly';
        return view('monthly-horoscope',compact('zodiacSigns','horoscopeType'));
    }
    public function yearly()
    {
        $zodiacSigns = ZodiacSign::with(['horoscope' => function ($query) {
            $query->where('horoscopeType', 'Yearly');
        }])
        ->where('status', 1)
        ->orderBy('created_at', 'asc')
        ->get();
        $horoscopeType = 'Yearly';
        return view('yearly-horoscope',compact('zodiacSigns','horoscopeType'));
    }
    public function details(Request $request)
    {
        $today = Carbon::now()->format('Y-m-d');
        $yesterday = Carbon::yesterday()->format('Y-m-d');
        $tomorrow = Carbon::tomorrow()->format('Y-m-d');
        $zodiac_signs = \App\Models\ZodiacSign::where('status',1)->orderBy('created_at','asc')->get();
        $todayHoroscope = DB::table('daily_horoscopes')
        ->join('zodiac_signs', 'daily_horoscopes.zodiac_sign_id', '=', 'zodiac_signs.id')
        ->select('daily_horoscopes.*', 'zodiac_signs.image', 'zodiac_signs.name')
        ->where('daily_horoscopes.zodiac_sign_id', '=', $request->zodiac_sign_id)
        ->where(DB::raw(DATEFORMAT), $request->horoscopeDate)
        ->get();
    
    $yesterDayHoroscope = DB::table('daily_horoscopes')
        ->join('zodiac_signs', 'daily_horoscopes.zodiac_sign_id', '=', 'zodiac_signs.id')
        ->select('daily_horoscopes.*', 'zodiac_signs.image', 'zodiac_signs.name')
        ->where('daily_horoscopes.zodiac_sign_id', '=', $request->zodiac_sign_id)
        ->where(DB::raw(DATEFORMAT), $request->horoscopeDate)
        ->get();
    
    $tomorrowHoroscope = DB::table('daily_horoscopes')
        ->join('zodiac_signs', 'daily_horoscopes.zodiac_sign_id', '=', 'zodiac_signs.id')
        ->select('daily_horoscopes.*', 'zodiac_signs.image', 'zodiac_signs.name')
        ->where('daily_horoscopes.zodiac_sign_id', '=', $request->zodiac_sign_id)
        ->where(DB::raw(DATEFORMAT), $request->horoscopeDate)
        ->get();
            
            $weeklyHoroScope = DB::table('horoscopes')
            ->join('zodiac_signs', 'horoscopes.zodiac_sign_id', '=', 'zodiac_signs.id')
            ->select('horoscopes.*', 'zodiac_signs.image', 'zodiac_signs.name')
            ->where('horoscopes.zodiac_sign_id', '=', $request->zodiac_sign_id)
            ->where('horoscopeType', '=', $request->horoscopeType)
            ->get();

            $monthlyHoroScope = DB::table('horoscopes')
            ->join('zodiac_signs', 'horoscopes.zodiac_sign_id', '=', 'zodiac_signs.id')
            ->select('horoscopes.*', 'zodiac_signs.image', 'zodiac_signs.name')
            ->where('horoscopes.zodiac_sign_id', '=', $request->zodiac_sign_id)
            ->where('horoscopeType', '=', $request->horoscopeType)
            ->get();
            $yearlyHoroScope = DB::table('horoscopes')
            ->join('zodiac_signs', 'horoscopes.zodiac_sign_id', '=', 'zodiac_signs.id')
            ->select('horoscopes.*', 'zodiac_signs.image', 'zodiac_signs.name')
            ->where('horoscopes.zodiac_sign_id', '=', $request->zodiac_sign_id)
            ->where('horoscopeType', '=', $request->horoscopeType)
            ->get();
            $todayHoroscopeStatics = DB::table('daily_horoscope_statics')
                ->where('zodiac_sign_id', '=', $request->zodiac_sign_id)
                ->where(DB::raw(DATEFORMAT), $request->horoscopeDate)
                ->get();
            $yesterHoroscopeStatics = DB::table('daily_horoscope_statics')
                ->where('zodiac_sign_id', '=', $request->zodiac_sign_id)
                ->where(DB::raw(DATEFORMAT), $request->horoscopeDate)
                ->get();
            $tomorrowHoroscopeStatics = DB::table('daily_horoscope_statics')
                ->where('zodiac_sign_id', '=', $request->zodiac_sign_id)
                ->where(DB::raw(DATEFORMAT), $request->horoscopeDate)
                ->get();
        return view('horoscope-details',compact('today','yesterday','tomorrow','zodiac_signs','todayHoroscope','yesterDayHoroscope','tomorrowHoroscope','todayHoroscopeStatics','yesterHoroscopeStatics','tomorrowHoroscopeStatics','weeklyHoroScope','monthlyHoroScope','yearlyHoroScope'));
    }
    // public function today()
    // {
    //     $dt = Carbon::now()->format('Y-m-d');
    //     $yesterday = Carbon::yesterday()->format('Y-m-d');
    //     $tomorrow = Carbon::tomorrow()->format('Y-m-d');
    //     $zodiacSigns = DB::Table('zodiac_signs')
    //     ->join('daily_horoscopes', 'daily_horoscopes.zodiac_sign_id', '=', 'zodiac_signs.id')
    //     ->where(DB::raw("DATE_FORMAT(daily_horoscopes.horoscopeDate, '%Y-%m-%d')"), $dt)
    //     ->select('zodiac_signs.*', 'daily_horoscopes.*')
    //     ->get();
    //     return view('today-horoscope',compact('zodiacSigns'));
    // }
    public function daily_horoscope(Request $request)
    {
            $dt = Carbon::now()->format('Y-m-d');
            $yesterday = Carbon::yesterday()->format('Y-m-d');
            $tomorrow = Carbon::tomorrow()->format('Y-m-d');
            $type = $request->type;
            switch ($type) {
                case 'today':
                $horoscope = DB::table('daily_horoscopes')
                ->where('zodiac_sign_id', '=', 1)
                ->where(DB::raw(DATEFORMAT), $dt)
                ->get();
                $horoscopeStatics = DB::table('daily_horoscope_statics')
                ->where('zodiac_sign_id', '=', 1)
                ->where(DB::raw(DATEFORMAT), $dt)
                ->get();
                break;
                case 'yesterday':
                $horoscope = DB::table('daily_horoscopes')
                ->where('zodiac_sign_id', '=', 1)
                ->where(DB::raw(DATEFORMAT), $yesterday)
                ->get();
                $horoscopeStatics = DB::table('daily_horoscope_statics')
                ->where('zodiac_sign_id', '=', 1)
                ->where(DB::raw(DATEFORMAT), $yesterday)
                ->get();
                break;
                case 'tomorrow':
                $horoscope = DB::table('daily_horoscopes')
                ->where('zodiac_sign_id', '=', 1)
                ->where(DB::raw(DATEFORMAT), $tomorrow)
                ->get();
                $horoscopeStatics = DB::table('daily_horoscope_statics')
                ->where('zodiac_sign_id', '=', 1)
                ->where(DB::raw(DATEFORMAT), $tomorrow)
                ->get();
                break;
                case 'weekly':
                $horoscope = DB::table('horoscopes')
                ->where('zodiac_sign_id', '=', 1)
                ->where('horoscopeType', '=', 'Weekly')
                ->get();
                if ($horoscope->isNotEmpty()) {
                    // If weekly horoscope data is available, assign an empty array to $horoscopeStatics
                    $horoscopeStatics = [];
                } else {
                    // If weekly horoscope data is not available, set $horoscope to null or any other desired value
                    $horoscope = null;
                    $horoscopeStatics = null;
                }
                break;
                case 'monthly':
                    $horoscope = DB::table('horoscopes')
                    ->where('zodiac_sign_id', '=', 1)
                    ->where('horoscopeType', '=', 'Monthly')
                    ->get();
                    if ($horoscope->isNotEmpty()) {
                        // If weekly horoscope data is available, assign an empty array to $horoscopeStatics
                        $horoscopeStatics = [];
                    } else {
                        // If weekly horoscope data is not available, set $horoscope to null or any other desired value
                        $horoscope = null;
                        $horoscopeStatics = null;
                    }
                    break;
                    case 'yearly':
                        $horoscope = DB::table('horoscopes')
                        ->where('zodiac_sign_id', '=', 1)
                        ->where('horoscopeType', '=', 'Yearly')
                        ->get();
                        if ($horoscope->isNotEmpty()) {
                            // If weekly horoscope data is available, assign an empty array to $horoscopeStatics
                            $horoscopeStatics = [];
                        } else {
                            // If weekly horoscope data is not available, set $horoscope to null or any other desired value
                            $horoscope = null;
                            $horoscopeStatics = null;
                        }
                        break;
    
            default:
                // Existing default case
                $horoscope = "No data found";
                $horoscopeStatics = "No data found";
            
                }    
        return view('horoscope',compact('horoscope','horoscopeStatics'));
    }
    public function fetchHoroscope(Request $request)
    {
        $zodiacSignId = $request->zodiacSignId;
        $type = $request->type;
        $date = Carbon::now()->format('Y-m-d');
        
        switch ($type) {
            case 'today':
                $horoscope = $this->getHoroscopeByDate($zodiacSignId, $date);
                $horoscope_scope = $this->getHoroscopeByDate_scope($zodiacSignId, $date);
                break;
            case 'yesterday':
                $date = Carbon::yesterday()->format('Y-m-d');
                $horoscope = $this->getHoroscopeByDate($zodiacSignId, $date);
                $horoscope_scope = $this->getHoroscopeByDate_scope($zodiacSignId, $date);
                break;
            case 'tomorrow':
                $date = Carbon::tomorrow()->format('Y-m-d');
                $horoscope = $this->getHoroscopeByDate($zodiacSignId, $date);
                $horoscope_scope = $this->getHoroscopeByDate_scope($zodiacSignId, $date);
                break;
            case 'weekly':
                    $horoscope_type = 'Weekly';
                    $horoscope = $this->getHoroscope($zodiacSignId, $horoscope_type);
                    $horoscope_scope = [];
                    break;
                    case 'monthly':
                        $horoscope_type = 'Monthly';
                        $horoscope = $this->getHoroscope($zodiacSignId, $horoscope_type);
                        $horoscope_scope = [];
                        break;
                        case 'yearly':
                            $horoscope_type = 'Yearly';
                            $horoscope = $this->getHoroscope($zodiacSignId, $horoscope_type);
                            $horoscope_scope = [];
                            break;
            
            default:
                $horoscope = []; 
                $horoscope_scope = [];
        }

        $mergedHoroscope = [
            'horoscope' => $horoscope,
            'statics' => $horoscope_scope,
        ];

        return response()->json($mergedHoroscope);
    }
    private function getHoroscope($zodiacSignId, $horoscope_type)
    {
        return DB::table('horoscopes')
            ->where('zodiac_sign_id', $zodiacSignId)
            ->where('horoscopeType', $horoscope_type)
            ->get();
    }

    private function getHoroscopeByDate($zodiacSignId, $date)
    {
        return DB::table('daily_horoscopes')
            ->where('zodiac_sign_id', $zodiacSignId)
            ->where(DB::raw(DATEFORMAT), $date)
            ->get();
    }
    private function getHoroscopeByDate_scope($zodiacSignId, $date)
    {
        return DB::table('daily_horoscope_statics')
            ->where('zodiac_sign_id', $zodiacSignId)
            ->where(DB::raw(DATEFORMAT), $date)
            ->get();
    }

    private function getHoroscopeByType($zodiacSignId, $type)
    {
        return DB::table('horoscopes')
            ->where('zodiac_sign_id', $zodiacSignId)
            ->where('horoscopeType', $type)
            ->first();
    }
    public function submitForm(Request $request)
    {
        // Get the birthdate from the request
    $selectedBirthdate = $request->input('birthdate');

    // Convert birthdate to a Carbon instance for easier comparison
    $selectedBirthdate = \Carbon\Carbon::createFromFormat('Y-m-d', $selectedBirthdate);
    $zodiac_sign = ZodiacSign::whereRaw('DATE_FORMAT(?, "%m-%d") BETWEEN DATE_FORMAT(date_from, "%m-%d") AND DATE_FORMAT(date_to, "%m-%d")', [$selectedBirthdate])
                             ->first();

                             if ($zodiac_sign) {
                                // If a zodiac sign is found, redirect back to the home page and pass the zodiac sign as a parameter
                                return view('zodiac-sign', compact('zodiac_sign'));
                            };
    }
    public function zodiac_sign()
    {
        
    }
    
}
