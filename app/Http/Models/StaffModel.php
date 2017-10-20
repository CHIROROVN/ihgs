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

    public function RulesImport()
    {
        return array(
            'file_csv'    => 'required|mimes:csv,xls,xlsx', 
        );
    }
    public function MessagesImport()
    {
        return array(
            'file_csv.required'      => trans('validation.error_file_path_required'),
            'file_csv.mimes'         => trans('validation.error_timecard_file_csv'),
        );
    }
    
    
    public function get_all($belong_id=null, $staff_name=null,$staff_id_no=null)
    {        
        $results = DB::table($this->table)->leftjoin('m_belong', 't_staff.staff_belong', '=', 'm_belong.belong_id')->where('t_staff.last_kind', '<>', DELETE);
        if(!empty($belong_id)){
              $results = $results->Where(function ($query) use ($belong_id) {
                                                            $query->where('m_belong.belong_id',  '=', $belong_id)
                                                                  ->orWhere('m_belong.belong_parent_id','=', $belong_id);
                                                        });
                   
        }   
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

    public function search_staff($where=null){

        $sql = DB::table($this->table)->where('t_staff.last_kind', '<>', DELETE);

        if(!empty($where['belong_parent_id'])){
            $sql = $sql->whereIn('t_staff.staff_belong', $where['belong_parent_id']);
        }
        
        if(!empty($where['kw'])){
            $sql = $sql->where('t_staff.staff_id_no', $where['kw'])->orWhere('t_staff.staff_name', 'like', '%'.$where['kw'].'%');
        }

    return $sql->get();
    }
    
}