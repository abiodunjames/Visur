<?php

namespace App\Http\Controllers;

 use App\Traits\EventTrait;
 use Illuminate\Http\Request;

 class EventController extends Controller
{
    use EventTrait;

     public  function index(){
         $events =$this->group_all();
         return view('pages.event',['events'=>$events]);
     }


     public  function get(Request $request){
         $severity=null;
         if($request->has('severity')){
             $severity=strtolower($request->severity);
         }
         $events=collect();
        if($severity !=null & in_array($severity,['low','medium','high'])){
             $method ='group_'.$severity;
             if(method_exists($this,$method)) {
                 $events = $this->$method(true);
             }
        }
        $data['events']=$events;
        $data['severity']=$severity;
        $data['current_page'] ='events';

       return view('pages.event',$data);

     }

     public function stats(){
         $critical_events =$this->high();
         $medium_events =$this->medium();
         $low_events =$this->low();
         $data['total_critical_events']=$critical_events->count();
         $data['total_medium_events']=$medium_events->count();
         $data['total_low_events'] =$low_events->count();
         $data['critical_events'] =$critical_events;
         $data['medium_events'] =$medium_events;
         $data['low_events'] =$low_events;
         return response()->json(['status'=>true,'data'=>$data]);

     }

     public  function event_severity_percentage(){
        $all_events =$this->all()->count();
        $medium_events =$this->medium()->count();
        $low_events  =$this->low()->count();
        $critical_events =$this->high()->count();
        $data['critical'] =$critical_events;
        $data['medium'] =$medium_events;
        $data['low'] =$low_events;
        return response()->json(['status'=>true,'data'=>$data]);
    }




}
