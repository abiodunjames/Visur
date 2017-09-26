<?php
namespace App\Http\Controllers;

 use App\Event;
 use Illuminate\Http\Request;
 use Yajra\Datatables\Datatables;

 class FilterEventController extends Controller
{
    public function __construct()
    {
    }

     /**
      * @return \BladeView|bool|\Illuminate\View\View
      */

     /**
      * @return array
      */
    private  function getFilters(){
       $filters =[
           'cid',
           'signature',
           'signature_gen',
           'signature_id',
           'timestamp',
           'unified_ref_time',
           'priority',
           'src_ip',
           'dst_ip',
           'src_port',
           'dst_port'
       ];
       return $filters;
    }

     /**
      * @param $key
      * @param $value
      * @return int
      */
    private function processFilterValue($key,$value){
    if($key=='src_ip' || $key=="dst_ip"){
        return ip2long($value);
    }
    return $value;
    }


     /**
      * @param Request $request
      * @param Datatables $datatables
      * @return \Illuminate\Http\JsonResponse
      */
    public  function filterEvent(Request $request){
        $params =collect($request->all());
        $query =Event::query();
        $filters =$this->getFilters();

        $params->each( function($value,$key) use($query,$filters){
            $value =$this->processFilterValue($key,$value);
            if(in_array($key,$filters)){
                return $query->where($key,$value);
            }
            return $query;
        });
        $events =$query->paginate(50);
        return view('events.filter_event',['events'=>$events,'filters'=>$params]);


    }



 }
