<?php
namespace App\Http\Controllers;

use App\Event;
use App\Traits\EventTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    use EventTrait;
    public function __construct()
    {
    }

    public function index()
    {
        $data['current_page'] = 'dashboard';
        $data['src_ip'] = Event::select('src_ip', DB::raw('count(*) as count'))->groupBy('src_ip')->take(10)->get();
        $data['signature'] = Event::select('signature', DB::raw('count(*) as count'))->groupBy('signature')->take(10)->get();
        $data['high'] =$this->high()->count();
        $data['medium'] =$this->medium()->count();
        $data['low'] =$this->low()->count();
        return view('pages.dashboard', $data);
    }

    public function barchart()
    {
        $last_seven_days = Carbon::now()->subDay(7)->format('Y-m-d');
        $events = Event::where('timestamp', '>=', $last_seven_days)
            ->select('timestamp', DB::raw('count(*) as count'))
            ->groupBy(DB::raw('CAST(timestamp AS DATE)'))
            ->get();
        $data['event'] = $events;
        $data['title'] = 'Event Count';
        $data['subtitle'] = 'Event Subtitle';
        $data['status'] = true;
        return response()->json($data);

    }

    public function piechart()
    {
        $last_seven_days = Carbon::now()->subDay(7)->format('Y-m-d');
        $high = Event::where('timestamp', '>=', $last_seven_days)->where('priority', config('event.priority.high'))->count();
        $medium = Event::where('timestamp', '>=', $last_seven_days)->where('priority', config('event.priority.medium'))->count();
        $low = Event::where('timestamp', '>=', $last_seven_days)->where('priority', config('event.priority.low'))->count();
        $data['event'] = array(
            ['name' => 'High', 'value' => $high],
            ['name' => 'medium', 'value' => $medium],
            ['name' => 'low', 'value' => $low]
        );
        $data['status'] = true;
        return response()->json($data);
    }



}
