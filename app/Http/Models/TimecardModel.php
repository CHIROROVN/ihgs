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
            //'tt_dataname' => 'required',                      
        );
    }

    public function Messages()
    {
        return array(
           // 'tt_dataname.required'  => trans('validation.error_tt_dataname_required'),
            
        );
    }
    
    public function get_all()
    {
        $results = DB::table($this->table)->where('last_kind', '<>', DELETE)->orderBy('mt_id', 'desc')->get();
        return $results;
    }
    public function insert($data)
    {
        $results = DB::table($this->table)->insert($data);        
        return $results;
    }
    public function get_by_id($id)
    {
        $results = DB::table($this->table)->where('mt_id', $id)->first();        
        return $results;
    }
    public function get_last_insert($staff_id='')    
    {
        if(!empty($staff_id))
            return DB::table($this->table)->where('last_kind', '<>', DELETE)->where('mt_staff_id_row', '=', $staff_id)->orderBy('mt_id', 'desc')->take(1)->get()->toArray();
        else
            return DB::table($this->table)->where('last_kind', '<>', DELETE)->orderBy('mt_id', 'desc')->take(1)->get()->toArray();
    } 
    public function insert_get_id($data)
    {
        return DB::table($this->table)->insertGetId($data);
    } 
    public function update($id, $data)
    {
        $results = DB::table($this->table)->where('mt_id', $id)->update($data);
        return $results;
    }    

}