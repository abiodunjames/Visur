<?php

namespace App\Http\Controllers;

 use App\Traits\EventTrait;

 class EventController extends Controller
{
    use EventTrait;

     public  function index(){
         $events =$this->all();
         return response()->json(['status'=>true,'data'=>$events]);

     }

     public  function get($severity=false){
         $events=[];
         if(!$severity){
             $events= $this->all();
         }
        if($severity & in_array($severity,['low','medium','high'])){
            $events =$this->$severity();
        }
        return response()->json(['status'=>true,'data'=>$events]);

     }


     public function stats(){
         $critical_events =$this->critical();
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
        $critical_events =$this->critical()->count();
        $data['critical'] =$critical_events/$all_events * 100;
        $data['medium'] =$medium_events/$all_events * 100;
        $data['low'] =$low_events/$all_events * 100;
        return response()->json(['status'=>true,'data'=>$data]);
    }


}
