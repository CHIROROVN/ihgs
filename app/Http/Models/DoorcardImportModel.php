<?php namespace App\Http\Models;

use DB;
use Hash;
use Auth;
use Validator;

class DoorcardImportModel
{
   protected $table = 't_doorcard';

    public function Rules()
    {
        return array(
            'td_dataname' => 'required',                      
        );
    }

    public function Messages()
    {
        return array(
           'td_dataname.required'  => trans('validation.error_td_dataname_required'),
            
        );
    }
    
    public function get_all()
    {
        $results = DB::table($this->table)->orderBy('td_id', 'desc')->get();
        return $results;
    }
    public function insert($data)
    {
        $results = DB::table($this->table)->insert($data);        
        return $results;
    }
    public function get_by_id($id)
    {
        $results = DB::table($this->table)->where('td_id', $id)->first();        
        return $results;
    }   
    public function insert_get_id($data)
    {
        return DB::table($this->table)->insertGetId($data);
    } 
    public function update($id, $data)
    {
        $results = DB::table($this->table)->where('td_id', $id)->update($data);
        return $results;
    }
     public function delete($dataname)
    {
        $results = DB::table($this->table)->where('td_dataname', $dataname)->delete();        
        return $results;
    }

}