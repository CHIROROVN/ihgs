<?php namespace App\Http\Models;

use DB;
use Hash;
use Auth;
use Validator;

class FileModel
{
    protected $table        = 'm_file';
    protected $primaryKey   = 'mf_id';

    public function Rules()
    {
        return array(
           'td_dataname' => 'required', 
            'file_csv'               => 'required|mimes:csv,xls,xlsx',                     
        );
    }

    public function Messages()
    {
        return array(           
           'td_dataname.required'  => trans('validation.error_td_dataname_required'),
           'file_csv.required'      => trans('validation.error_file_path_required'),
           'file_csv.mimes'         => trans('validation.error_timecard_file_csv'),
        );
    }    
    public function get_all()
    {
        $results = DB::table($this->table)->where('last_kind', '<>', DELETE)->orderBy('mf_id', 'desc')->get();
        return $results;
    }
    public function get_all_by_type($intType)
    {
        $results = DB::table($this->table)->where('mf_type_import', '=', $intType)->where('last_kind', '<>', DELETE)->orderBy('mf_id', 'desc')->get();

        return $results;
    }
    public function insert($data)
    {
        $results = DB::table($this->table)->insert($data);               
        return $results;
    }
    public function get_by_id($id)
    {
        $results = DB::table($this->table)->where('mf_id', $id)->first();        
        return $results;
    }     
     public function get_by_dataname($file_name,$intType)
    {
      
        $results = DB::table($this->table)->where('mf_dataname', $file_name)->where('mf_type_import', '=', $intType)->first();            

        return $results;
    }   
    public function insert_get_id($data)
    {
        return DB::table($this->table)->insertGetId($data);
    } 
    public function update($id, $data)
    {
        $results = DB::table($this->table)->where('mf_id', $id)->update($data);
        return $results;
    }
    

}