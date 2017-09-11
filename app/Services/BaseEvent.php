<?php
declare(strict_types = 1);


namespace App\Services;

use App\Event;
use Illuminate\Support\Facades\DB;

class BaseEvent implements IEventReport
{

    public $min_date = null;
    public $max_date = null;
    public $event;

    public function __construct()
    {
        $this->event = Event::class;
    }

    public function low()
    {
        if ($this->min_date == null || $this->max_date == null) {
            return Event::where('priority', config('event.priority.low'));
        }
        return Event::where('priority', config('event.priority.low'))->where('timestamp', '>=', $this->min_date)->where('timestamp', '<=', $this->max_date);
    }

    public function high()
    {
        if ($this->min_date == null || $this->max_date == null) {
            return Event::where('priority', config('event.priority.high'));
        }
        return Event::where('priority', config('event.priority.high'))->where('timestamp', '>=', $this->min_date)->where('timestamp', '<=', $this->max_date);


    }

    public function medium()
    {
        if ($this->min_date == null || $this->max_date == null) {
            return Event::where('priority', config('event.priority.medium'));
        }
        return Event::where('priority', config('event.priority.medium'))->where('timestamp', '>=', $this->min_date)->where('timestamp', '<=', $this->max_date);
    }


    public function top_src_ip()
    {
        if ($this->min_date == null || $this->max_date == null) {
         return   Event::select('src_ip', DB::raw('count(*) as count'))->groupBy('src_ip')->take(10)->get();
        }

      return  Event::where('timestamp', '>=', $this->min_date)
          ->where('timestamp', '<=', $this->max_date)
          ->select('src_ip', DB::raw('count(*) as count'))
          ->groupBy('src_ip')->take(10)->get();
    }


    public function top_signature()
    {
        if ($this->min_date == null || $this->max_date == null) {
            return Event::select('signature', DB::raw('count(*) as count'))
                ->groupBy('signature')->take(10)->get();
        }
       return Event::where('timestamp', '>=', $this->min_date)
           ->where('timestamp', '<=', $this->max_date)
           ->select('signature', DB::raw('count(*) as count'))
           ->groupBy('signature')->take(10)->get();

    }


    public function piechart()
    {
        if ($this->min_date != null && $this->max_date != null) {
            $high = Event::where('timestamp', '>=', $this->min_date)->where('timestamp', '<=', $this->max_date)->where('priority', config('event.priority.high'))->count();
            $medium = Event::where('timestamp', '>=', $this->min_date)->where('timestamp', '<=', $this->max_date)->where('priority', config('event.priority.medium'))->count();
            $low = Event::where('timestamp', '>=', $this->min_date)->where('timestamp', '<=', $this->max_date)->where('priority', config('event.priority.low'))->count();
        } else {
            $high = Event::where('priority', config('event.priority.high'))->count();
            $medium = Event::where('priority', config('event.priority.medium'))->count();
            $low = Event::where('priority', config('event.priority.low'))->count();
        }

        $data['event'] = array(
            ['name' => 'High', 'value' => $high],
            ['name' => 'medium', 'value' => $medium],
            ['name' => 'low', 'value' => $low]
        );
        $data['status'] = true;
        return response()->json($data);
    }


    public function barchart()
    {
        if ($this->min_date != null && $this->max_date != null) {
            $events = Event::where('timestamp', '>=', $this->min_date)->where('timestamp', '<=', $this->max_date)
                ->select('timestamp', DB::raw('count(*) as count'))
                ->groupBy(DB::raw('CAST(timestamp AS DATE)'))
                ->get();

        } else {
            $events = Event::select('timestamp', DB::raw('count(*) as count'))
                ->groupBy(DB::raw('CAST(timestamp AS DATE)'))
                ->get();
        }
        $data['event'] = $events;
        $data['title'] = 'Event Count';
        $data['subtitle'] = 'Event Subtitle';
        $data['status'] = true;
        return response()->json($data);
    }
}
