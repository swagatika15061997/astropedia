<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ZodiacSign;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;
define('DATEFORMAT', "(DATE_FORMAT(horoscopeDate,'%Y-%m-%d'))");

class DailyHoroScopeController extends Controller
{
    public function getDailyHoroscope(Request $request)
    {
        
                $dailyHoroscope = DB::table('daily_horoscopes');
                $dailyHoroscopeStatics = DB::table('daily_horoscope_statics');
                if ($request->filterDate) {
                    $filterDate = Carbon::parse($request->filterDate)->format('Y-m-d');
                    $dailyHoroscope = $dailyHoroscope->where(DB::raw(DATEFORMAT), $filterDate);
                    $dailyHoroscopeStatics = $dailyHoroscopeStatics->where(DB::raw(DATEFORMAT), $filterDate);
                } else {
                    $dt = Carbon::now()->format('Y-m-d');
                    $dailyHoroscope = $dailyHoroscope->where(DB::raw(DATEFORMAT), $dt);
                    $dailyHoroscopeStatics = $dailyHoroscopeStatics->where(DB::raw(DATEFORMAT), $dt);
                }
                if ($request->filterSign) {
                    $dailyHoroscope = $dailyHoroscope->where("zodiac_sign_id", '=', $request->filterSign);
                    $dailyHoroscopeStatics = $dailyHoroscopeStatics->where("zodiac_sign_id", '=', $request->filterSign);
                } else {
                    $dailyHoroscope = $dailyHoroscope->where("zodiac_sign_id", '=', 1);
                    $dailyHoroscopeStatics = $dailyHoroscopeStatics->where("zodiac_sign_id", '=', 1);
                }
                $dailyHoroscope = $dailyHoroscope->get();
                $dailyHoroscopeStatics = $dailyHoroscopeStatics->get();
                $hororscopeSign = ZodiacSign::query();
                $signs = $hororscopeSign->orderBy('id', 'ASC')->get();

                $selectedId = $request->filterSign ? $request->filterSign : $signs[0]['id'];
                $filterDate = $request->filterDate ? Carbon::parse($request->filterDate)->format('Y-m-d') : Carbon::Now()->format('Y-m-d');
                return view('admin.horoscope.daily-horoscope', compact('dailyHoroscope', 'dailyHoroscopeStatics', 'signs', 'selectedId', 'filterDate'));
           
    }
    public function store_horoscope_daily(Request $req)
    {
        
                $state = DB::table('daily_horoscope_statics')->where('zodiac_sign_id', $req->zodiacSignId)->where('horoscopeDate', $req->horoscopeDate)->get();
                $statics = array(
                    'luckyTime' => $req->luckyTime,
                    'luckyColor' => $req->luckyColour,
                    'luckyNumber' => $req->luckyNumber,
                    'moodday' => $req->moodday,
                    'zodiac_sign_id' => $req->zodiacSignId,
                    'horoscopeDate' => $req->horoscopeDate,
                );
                if ($state && count($state) > 0) {
                    DB::table('daily_horoscope_statics')->where('id', '=', $state[0]->id)->update($statics);
                } else {

                    DB::table('daily_horoscope_statics')->insert($statics);
                }
                $this->addDaily('Love', $req->zodiacSignId, $req->horoscopeDate, $req->lovepercent, $req->lovedesc,null,null);
                $this->addDaily('Career', $req->zodiacSignId, $req->horoscopeDate, $req->careerpercent, $req->careerdesc,null,null);
                $this->addDaily('Health', $req->zodiacSignId, $req->horoscopeDate, $req->healthpercent, $req->healthdesc,null,null);
                $this->addDaily('Money', $req->zodiacSignId, $req->horoscopeDate, $req->moneypercent, $req->moneydesc,null,null);
                $this->addDaily('Travel', $req->zodiacSignId, $req->horoscopeDate, $req->travelpercent, $req->traveldesc,null,null);
                return redirect()->route('horoscope.dailyHoroscope')->with('success', 'Daily Horoscope added successfully.');
           
    }
    public function edit_daily(Request $req)
    {
        $zodiacSignId = $req->zodiacSignId;
        $horoscopeDate = $req->horoscopeDate;
        $dailyHoroscope = DB::table('daily_horoscopes')->where('zodiac_sign_id', $req->zodiacSignId)->where('horoscopeDate', $req->horoscopeDate)->get();
        $loveDesc = '';
        $lovePercent = '';
        $healthDesc = '';
        $healthPercent = '';
        $careerDesc = '';
        $careerPercent = '';
        $travelDesc = '';
        $travelPercent = '';
        $moneyDesc = '';
        $moneyPercent = '';
        if ($dailyHoroscope && count($dailyHoroscope) > 0) {

            for ($i = 0; $i < count($dailyHoroscope); $i++) {
                if ($dailyHoroscope[$i]->category == 'Love') {
                    $loveDesc = $dailyHoroscope[$i]->description;
                    $lovePercent = $dailyHoroscope[$i]->percentage;
                }
                if ($dailyHoroscope[$i]->category == 'Health') {
                    $healthDesc = $dailyHoroscope[$i]->description;
                    $healthPercent = $dailyHoroscope[$i]->percentage;
                }
                if ($dailyHoroscope[$i]->category == 'Career') {
                    $careerDesc = $dailyHoroscope[$i]->description;
                    $careerPercent = $dailyHoroscope[$i]->percentage;
                }
                if ($dailyHoroscope[$i]->category == 'Travel') {
                    $travelDesc = $dailyHoroscope[$i]->description;
                    $travelPercent = $dailyHoroscope[$i]->percentage;
                }
                if ($dailyHoroscope[$i]->category == 'Money') {
                    $moneyDesc = $dailyHoroscope[$i]->description;
                    $moneyPercent = $dailyHoroscope[$i]->percentage;
                }
            }
        }
        $data = array(
            'loveDesc' => $loveDesc ? $loveDesc : '',
            'lovePercent' => $lovePercent ?$lovePercent : '' ,
            'careerDesc' => $careerDesc ? $careerDesc : '',
            'careerPercent' => $careerPercent ? $careerPercent : '',
            'healthDesc' => $healthDesc ?  $healthDesc : '',
            'healthPercent' => $healthPercent ? $healthPercent : '',
            'moneyDesc' => $moneyDesc ? $moneyDesc : '',
            'moneyPercent' => $moneyPercent ? $moneyPercent : '',
            'travelDesc' => $travelDesc ? $travelDesc : '',
            'travelPercent' => $travelPercent ? $travelPercent : '',
        );
        $dailyHoroscopeStatics = DB::table('daily_horoscope_statics')->where('zodiac_sign_id', $req->zodiacSignId)->where('horoscopeDate', $req->horoscopeDate)->get();
        $zodiacSign = ZodiacSign::query();
        $signs = $zodiacSign->where('status', true)->orderBy('id', 'DESC')->get();
        return view('admin.horoscope.edit-daily-horoscope', compact('signs', 'dailyHoroscopeStatics', 'data', 'zodiacSignId', 'horoscopeDate'));
    }
    public function upadateDailyHoroscope(Request $req)
    {
       
        $state = DB::table('daily_horoscope_statics')->where('zodiac_sign_id', $req->zodiacSignId)->where('horoscopeDate', $req->horoscopeDate)->get();
        $statics = array(
            'luckyTime' => $req->luckyTime,
            'luckyColor' => $req->luckyColour,
            'luckyNumber' => $req->luckyNumber,
            'moodday' => $req->moodday,
            'zodiac_sign_id' => $req->zodiacSignId,
            'horoscopeDate' => $req->horoscopeDate,
        );
        if ($state && count($state) > 0) {
            DB::table('daily_horoscope_statics')->where('id', '=', $state[0]->id)->update($statics);
        } else {
            DB::table('daily_horoscope_statics')->where('zodiac_sign_id', $req->oldSignId)->where('horoscopeDate', $req->oldHoroDate)->delete();
            DB::table('daily_horoscope_statics')->insert($statics);
        }
        $this->addDaily('Love', $req->zodiacSignId, $req->horoscopeDate, $req->lovepercent, $req->lovedesc, $req->oldSignId, $req->oldHoroDate);
        $this->addDaily('Career', $req->zodiacSignId, $req->horoscopeDate, $req->careerpercent, $req->careerdesc, $req->oldSignId, $req->oldHoroDate);
        $this->addDaily('Health', $req->zodiacSignId, $req->horoscopeDate, $req->healthpercent, $req->healthdesc, $req->oldSignId, $req->oldHoroDate);
        $this->addDaily('Money', $req->zodiacSignId, $req->horoscopeDate, $req->moneypercent, $req->moneydesc, $req->oldSignId, $req->oldHoroDate);
        $this->addDaily('Travel', $req->zodiacSignId, $req->horoscopeDate, $req->travelpercent, $req->traveldesc, $req->oldSignId, $req->oldHoroDate);
        return redirect()->route('horoscope.dailyHoroscope')->with('success', 'Daily Horoscope updated successfully.');
           
    }
    public function addDaily($category, $zodiacSignId, $horoscopeDate, $percent, $description, $oldSignId, $oldHoroDate)
    {
        $data = DB::table('daily_horoscopes')->where('category', $category)->where('zodiac_sign_id', $zodiacSignId)->where('horoscopeDate', $horoscopeDate)->get();
        $daily = array(
            'category' => $category,
            'description' => $description,
            'percentage' => $percent,
            'zodiac_sign_id' => $zodiacSignId,
            'horoscopeDate' => $horoscopeDate,
        );
        if ($data && count($data) > 0) {

            DB::table('daily_horoscopes')->where('id', $data[0]->id)->update($daily);
        } else {
            if ($oldSignId && $oldHoroDate) {
                DB::table('daily_horoscopes')->where('category', $category)->where('zodiac_sign_id', $oldSignId)->where('horoscopeDate', $oldHoroDate)->delete();
            }
            DB::table('daily_horoscopes')
                ->insert($daily);
        }
    }
    public function delete_horoscope_daily(Request $req)
    {
        
                DB::table('daily_horoscopes')->where('zodiac_sign_id', '=', $req->del_id)->where('horoscopeDate',$req->horoscope_date)->delete();
                DB::table('daily_horoscope_statics')->where('zodiac_sign_id', '=', $req->del_id)->where('horoscopeDate',$req->horoscope_date)->delete();
                return redirect()->route('horoscope.dailyHoroscope')->with('success', 'Daily Horoscope deleted successfully.');
            
    }
    
}
