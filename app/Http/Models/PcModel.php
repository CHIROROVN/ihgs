<?php namespace App\Http\Models;

use DB;
use Validator;

class PcModel
{
    protected $table   = 'm_pc';
    protected $primaryKey   = 'mp_id';
    public $timestamps  = false;

    public function Rules()
    {
        return array();
    }

    public function Messages()
    {
        return array();
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
        return DB::table($this->table)->where('mp_id', $id)->update($data);
    }

}