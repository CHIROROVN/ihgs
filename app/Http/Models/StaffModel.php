<?php namespace App\Http\Models;

use DB;
use Validator;

class StaffModel
{
   
   protected $table = 't_staff';

    public function Rules()
    {
        return array(
            'mt_staff_id_row' => 'required', 
        );
    }

    public function Messages()
    {
        return array(
            'mt_staff_id_row.required'  => trans('validation.error_tt_dataname_required'),
        );
    }
    
    public function get_all()
    {
        $results = DB::table($this->table)->orderBy('staff_id', 'desc')->get();
        return $results;
    }
    public function insert($data)
    {
        $results = DB::table($this->table)->insert($data);
        return $results;
    }
      

}