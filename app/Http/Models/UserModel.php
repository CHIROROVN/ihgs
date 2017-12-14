<?php namespace App\Http\Models;

use DB;
use Hash;
use Auth;
use Validator;

class UserModel
{
    protected $table   = 'm_user';
    protected $primaryKey   = 'u_id';
    public $timestamps  = false;

    public function Rules()
    {
        return array(
            'u_name'                       => 'required',
            'u_login'                      => 'required|unique:m_user',
            'u_passwd'                     => 'required|min:6',
            //'u_belong'                      => 'required',
         );
    }

    public function Messages()
    {
        return array(
            'u_name.required'              => trans('validation.error_u_name_required'),
            'u_login.required'             => trans('validation.error_u_login_required'),
            'u_login.unique'               => trans('validation.error_u_login_unique'),
            'u_passwd.required'            => trans('validation.error_u_passwd_required'),
            'u_passwd.min'                 => trans('validation.error_u_passwd_min'),
            //'u_belong.required'            => trans('validation.error_u_belong_required'),
        );
    }

    public function RulesLogin()
    {
        return array(
            'u_login'                      => 'required',
            'u_passwd'                     => 'required',
        );
    }

    public function MessagesLogin()
    {
        return array(
            'u_login.required'             => trans('validation.error_u_login_required'),
            'u_passwd.required'            => trans('validation.error_u_passwd_required'),
        );
    }

  //Manage All Users
    public function getAllUser(){
        return DB::table($this->table)->where('last_kind', '<>', DELETE)->orderBy('u_name', 'ASC')->orderBy('last_date', 'DESC')->simplePaginate(LIMIT_PAGE);
    }

    //users insert
    public function insert($data)
    {
        return DB::table($this->table)->insert($data);
    }

    //users get by id
    public function get_by_id($id)
    {
        return DB::table($this->table)->where('last_kind', '<>', DELETE)->where('u_id', $id)->first();
    }

    // get u_login by id
    // public function uBelong($id)
    // {
    //     return DB::table($this->table)->select('u_login')->where('u_id', $id)->first();
    // }

    //users update
    public function update($id, $data)
    {
        return DB::table($this->table)->where('u_id', $id)->update($data);
    }

}