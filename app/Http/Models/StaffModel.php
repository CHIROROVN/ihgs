<?php namespace App\Http\Models;

use DB;
use Validator;

class StaffModel
{
   
   protected $table = 't_staff';

    public function Rules()
    {
        return array(
            'staff_id_no' => 'required', 
            'staff_name' => 'required', 
        );
    }

    public function Messages()
    {
        return array(
            'staff_id_no.required'  => trans('validation.error_staff_id_no_required'),
            'staff_name.required'  => trans('validation.error_staff_name_required'),
        );
    }
    
    public function get_all($belong_id=null, $staff_name=null,$staff_id_no=null)
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