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
            'file_csv'               => 'required|mimes:csv,xls,xlsx', 
        );
    }

    public function Messages()
    {
        return array(
            'tt_dataname.required'  => trans('validation.error_tt_dataname_required'),
            'file_csv.required'      => trans('validation.error_file_path_required'),
            'file_csv.mimes'         => trans('validation.error_timecard_file_csv'),
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