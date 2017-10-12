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
            'staff_name.required'   => trans('validation.error_staff_name_required'),
        );
    }
    
    public function get_all($belong_id=null, $staff_name=null,$staff_id_no=null)
    {        
        $results = DB::table($this->table)->join('m_belong', 't_staff.staff_belong', '=', 'm_belong.belong_id')->where('t_staff.last_kind', '<>', DELETE);
        if(!empty($belong_id))     $results = $results->where('staff_belong',  '=', $belong_id);       
        if(!empty($staff_name))     $results = $results->where('staff_name',   'like', '%' . $staff_name . '%');
        if(!empty($staff_id_no))     $results = $results->where('staff_id_no', 'like', '%' . $staff_id_no . '%');

        $count = $results->count();
        $data  = $results->orderBy('staff_id', 'desc')->simplePaginate(LIMIT_PAGE);
       // $data  = $results->orderBy('staff_id', 'desc')->Paginate(LIMIT_PAGE);
        return [
            'count' => $count,
            'data' => $data
        ];
       /* $results = DB::table($this->table)->where('last_kind', '<>', DELETE)->orderBy('staff_id', 'desc')->simplePaginate(LIMIT_PAGE);
        return $results;*/
    }

    public function insert($data)
    {
        $results = DB::table($this->table)->insert($data);
        return $results;
    }

    public function get_by_id($id)
    {
        $results = DB::table($this->table)->where('staff_id', $id)->first();        
        return $results;
    }
    
    public function update($id, $data)
    {
        $results = DB::table($this->table)->where('staff_id', $id)->update($data);
        return $results;
    }  
    
}