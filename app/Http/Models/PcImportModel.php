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
            'tp_file_csv'               => 'mimes:csv',
        );
    }

    public function Messages()
    {
        return array(
            'tp_file_csv.mimes'         => trans('validation.error_tp_file_csv_mimes'),
        );
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
        return DB::table($this->table)->where('tp_id', $id)->update($data);
    }

}