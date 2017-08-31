<?php
namespace App\Http\Controllers;

 use App\Event;

 class DistinctEventController extends  Controller
{


    public  function all(){
        $event =Event::orderBy('timestamp','desc')->groupBy('signature')->get();
        return response(['status'=>true,'data'=>$event]);

    }




}
