<?php namespace App\Http\Models;

use DB;
use Hash;
use Auth;
use Validator;

class BelongModel
{
    protected $table = 'm_belong';

    public function Rules()
    {
        return array(
            'belong_name' => 'required',
            'belong_code' => 'required',
        );
    }

    public function Messages()
    {
        return array(
            'belong_name.required'  => trans('validation.error_belong_name_required'),
            'belong_code.required'  => trans('validation.error_belong_code_required'),
        );
    }

    public function get_all()
    {
        $results = DB::table($this->table)->where('last_kind', '<>', DELETE)->orderBy('belong_sort', 'asc')->get();
        return $results;
    }

    public function get_all_division()
    {
        $results = DB::table($this->table)->where('last_kind', '<>', DELETE)->whereNull('belong_parent_id')->orderBy('belong_sort', 'asc')->get();


        return $results;
    }

    public function get_all_section($id)
    {
        $results = DB::table($this->table)->where('last_kind', '<>', DELETE)->where('belong_parent_id', '=', $id)->orderBy('belong_sort', 'asc')->get();
        return $results;
    }

    public function get_for_select($where = array())
    {
        $db = DB::table($this->table)->select('belong_id', 'belong_name', 'belong_code')->where('last_kind', '<>', DELETE);

        //belong_code
        if ( !empty($where['s_belong_code']) ) {
            $db = $db->where('belong_code', $where['s_belong_code']);
        }

        $db = $db->orderBy('belong_sort', 'asc')->get();
        return $db;
    }

    public function insert($data)
    {
        $results = DB::table($this->table)->insert($data);
        return $results;
    }

    public function get_by_id($id)
    {
        $results = DB::table($this->table)->where('belong_id', $id)->first();
        return $results;
    }

     public function get_by_belong_name($belong_name)
    {
        $results = DB::table($this->table)->where('belong_name','like', '%'.$belong_name.'%')->where('last_kind', '<>', DELETE)->first();
        return $results;
    }

    public function update($id, $data)
    {
        $results = DB::table($this->table)->where('belong_id', $id)->update($data);
        return $results;
    }
    /*  Delete division and section*/
    public function delete($id, $data)
    {
        $results = DB::table($this->table)->where('belong_id', $id)->orWhere('belong_parent_id', '=', $id)->update($data);        
        return $results;
    }

    public function get_min($parent_id='')
    {
        $results = ($parent_id=='')?DB::table($this->table)->whereNull('belong_parent_id')->min('belong_sort'):DB::table($this->table)->where('belong_parent_id', '=', $parent_id)->min('belong_sort');
        return $results;
    }

    public function get_max($parent_id='')
    {
        $results = ($parent_id=='')?DB::table($this->table)->whereNull('belong_parent_id')->max('belong_sort'):DB::table($this->table)->where('belong_parent_id', '=', $parent_id)->max('belong_sort');
        return $results;
    } 
    public function get_list_section()
    {
        return DB::table($this->table)->where('last_kind', '<>', DELETE)->whereNotNull('belong_parent_id')->orderBy('belong_sort', 'asc')->get();
    }

    static function get_division_by_id($belong_id)
    {
        return DB::table('m_belong')->select('belong_name')->where('last_kind', '<>', DELETE)->where('belong_id', '=', $belong_id)->first();
    }

    static function list_division_tree()
    {
        return DB::table('m_belong')->select('belong_id', 'belong_name', 'belong_parent_id')->where('last_kind', '<>', DELETE)->orderBy('belong_parent_id', 'desc')->get();
    }

    //Search working time
    public function work_monthly($where=null){
        $sql = DB::table($this->table)
                ->leftJoin('t_staff', 'm_belong.belong_id', '=', 't_staff.staff_belong')
                ->leftJoin('t_timecard', 't_staff.staff_id_no', 't_timecard.tt_staff_id_no')
                //->leftJoin('t_pc', 't_staff.staff_id_no', 't_pc.tp_id')
                ->leftJoin('t_pc', 't_staff.staff_id_no', 't_pc.tp_pc_no')
                ->select('m_belong.belong_id', 'm_belong.belong_name', 't_staff.*', 't_timecard.tt_date', 't_timecard.tt_gotime', 't_timecard.tt_backtime')
                ->where('m_belong.last_kind', '<>', DELETE)
                ->where('t_staff.last_kind', '<>', DELETE);

        // if(!empty($where['belong_id'])){
        //     $sql = $sql->where('m_belong.m_belong', $where['belong_id']);
        // }

        // if(!empty($where['kw'])){
        //     $sql = $sql->where('t_staff.staff_id_no', $where['kw'])->orWhere('t_staff.staff_name', 'like', '%'.$where['kw'].'%');
        // }

        return $sql->get();
    }

}