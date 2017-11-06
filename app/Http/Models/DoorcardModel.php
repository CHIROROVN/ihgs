<?php namespace App\Http\Models;

use DB;
use Hash;
use Auth;
use Validator;

class DoorcardModel
{
    protected $table        = 'm_doorcard';
    protected $primaryKey   = 'md_id';

    public function Rules()
    {
        return array(
            'md_door_format' => 'required',                      
        );
    }

    public function Messages()
    {
        return array(
           'md_door_format.required'  => trans('validation.error_door_format_required')            
        );
    }
    
    public function get_all()
    {
        $results = DB::table($this->table)->where('last_kind', '<>', DELETE)->orderBy('md_id', 'desc')->get();
        return $results;
    }
    public function insert($data)
    {
        $results = DB::table($this->table)->insert($data);               
        return $results;
    }
    public function get_by_id($id)
    {
        $results = DB::table($this->table)->where('md_id', $id)->first();        
        return $results;
    }   
    public function insert_get_id($data)
    {
        return DB::table($this->table)->insertGetId($data);
    } 
    public function update($id, $data)
    {
        $results = DB::table($this->table)->where('md_id', $id)->update($data);
        return $results;
    }
    public function getLastRow()
    {
       $results = DB::table($this->table)->where('last_kind', '<>', DELETE)->orderBy('md_id', 'desc')->first(); 
       return $results;
    }

}