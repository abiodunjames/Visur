<?php

namespace App;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Event extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table='event';

    const CREATED_AT = 'timestamp';

    /**
     * The name of the "updated at" column.
     *
     * @var string
     */
    const UPDATED_AT = 'last_modified';

    public  function getSrcIpAttribute($value){
        return long2ip((float)$value);
    }

    public  function getDstIpAttribute($value){
        return long2ip((float)$value);
    }
    public function getTimestampAttribute($value){
        if($value!=null) {
            $value= Carbon::parse($value)->format('d/m/y');
        }
        return $value;
    }
}
