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

    public function update($id, $data)
    {
        $results = DB::table($this->table)->where('belong_id', $id)->update($data);
        return $results;
    }

    public function get_min()
    {
        $results = DB::table($this->table)->min('belong_sort');
        return $results;
    }

    public function get_max()
    {
        $results = DB::table($this->table)->max('belong_sort');
        return $results;
    }

}