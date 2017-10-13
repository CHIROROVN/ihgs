<?php namespace App\Http\Models;

use DB;
use Validator;

class WorkingTimeModel
{
    protected $table   = 't_staff';
    protected $primaryKey   = '';
    public $timestamps  = false;

    public function Rules()
    {
        return array();
    }

    public function Messages()
    {
        return array();
    }

    public function get_all($belong_id=null, $year=null)
    {        
        $results = DB::table($this->table)->join('m_belong', 't_staff.staff_belong', '=', 'm_belong.belong_id')->where('t_staff.last_kind', '<>', DELETE);
        if(!empty($belong_id))     $results = $results->where('staff_belong',  '=', $belong_id);               

        $count = $results->count();
        $data  = $results->orderBy('staff_id', 'desc')->get();       
        return [
            'count' => $count,
            'data' => $data
        ];      
    }
    public function get_by_id($id)
    {
        $results = DB::table($this->table)->join('m_belong', 't_staff.staff_belong', '=', 'm_belong.belong_id')->where('staff_id', $id)->first();
        return $results;
    }

  //Manage Pc format
    public function getPc(){
        return DB::table($this->table)->where('last_kind', '<>', DELETE)->first();
    }



    //pc insert
    public function insert($data)
    {
        return DB::table($this->table)->insert($data);
    }

    //pc update
    public function update($id, $data)
    {
        return DB::table($this->table)->where('id', $id)->update($data);
    }

}