<?php namespace App\Http\Models;

use DB;
use Validator;

class PcImportModel
{
    protected $table   = 't_pc';
    protected $primaryKey   = 'tp_id';
    public $timestamps  = false;

    public function Rules()
    {
        return array(
            'tp_dataname'               => 'required|unique:t_pc,tp_dataname',
            'tp_file_csv'               => 'required|mimes:csv',
        );
    }

    public function Messages()
    {
        return array(
            'tp_dataname.required'      => trans('validation.error_tp_dataname_required'),
            'tp_dataname.unique'        => trans('validation.error_tp_dataname_unique'),
            'tp_file_csv.required'      => trans('validation.error_tp_file_csv_required'),
            'tp_file_csv.mimes'         => trans('validation.error_tp_file_csv_mimes'),
        );
    }

   
  //Manage Pc format
    public function getPc(){
        return DB::table($this->table)->get();
    }

    //pc insert
    public function insert($data)
    {
        return DB::table($this->table)->insert($data);
    }

    //pc update
    public function update($id, $data)
    {
        return DB::table($this->table)->where('tp_id', $id)->update($data);
    }

    //pc delete by tp_dataname
    public function delete($tp_dataname)
    {
        return DB::table($this->table)->where('tp_dataname', $tp_dataname)->delete();
    }

}