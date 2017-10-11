<?php namespace App\Http\Models;

use DB;
use Validator;

class TimecardImportModel
{
   
   protected $table = 't_timecard';

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
        $results = DB::table($this->table)->orderBy('tt_id', 'desc')->get();
        return $results;
    }
    public function insert($data)
    {
        $results = DB::table($this->table)->insert($data);
        return $results;
    }
     public function delete($dataname)
    {
        $results = DB::table($this->table)->where('tt_dataname', $dataname)->delete();        
        return $results;
    }      

}