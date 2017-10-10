<?php namespace App\Http\Models;

use DB;
use Hash;
use Auth;
use Validator;

class TimecardModel
{
   protected $table = 'm_timecard';

    public function Rules()
    {
        return array(
            'tt_dataname' => 'required',                      
        );
    }

    public function Messages()
    {
        return array(
            'tt_dataname.required'  => trans('validation.error_tt_dataname_required'),
            
        );
    }
    
    public function get_all()
    {
        $results = DB::table($this->table)->where('last_kind', '<>', DELETE)->orderBy('mt_id', 'desc')->get();
        return $results;
    }
      

}