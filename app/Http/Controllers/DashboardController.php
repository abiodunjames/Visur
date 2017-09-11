<?php
namespace App\Http\Controllers;

use App\Services\Today;
use App\Traits\EventTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    use EventTrait;

    public function __construct()
    {
    }

    public function index(Request $request)
    {

        $object = new Today();
        if ($request->has('timeline')) {
            $timeline = $request->timeline;
            $class = '\\App\\Services\\' . ucfirst($timeline);
            if (class_exists($class)) {
                $object = new $class();
            }
        }
        $data['high'] = $object->high()->count();

        $data['medium'] = $object->medium()->count();

        $data['low'] = $object->low()->count();

        $data['selected'] = strtolower(class_basename($object));
        $data['current_page'] = 'dashboard';
        $data['src_ip'] = $object->top_src_ip();
        $data['signature'] = $object->top_signature();
        $data['min_date']=Carbon::parse($object->min_date)->format('l jS \of F Y h:i:s A');
        $data['max_date']=Carbon::parse($object->max_date)->format('l jS \of F Y h:i:s A');
        return view('pages.dashboard', $data);

    }


    public function barchart(Request $request)
    {
        $object = new Today();
        if ($request->has('timeline')) {
            $timeline = $request->timeline;
            $class = '\\App\\Services\\' . ucfirst($timeline);
            if (class_exists($class)) {
                $object = new $class();
            }
        }
        return $object->barchart();


    }

    public function piechart(Request $request)
    {
        $object = new Today();
        if ($request->has('timeline')) {
            $timeline = $request->timeline;
            $class = '\\App\\Services\\' . ucfirst($timeline);
            if (class_exists($class)) {
                $object = new $class();
            }
        }
        return $object->piechart();
    }


}
