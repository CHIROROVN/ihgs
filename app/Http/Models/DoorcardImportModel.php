<?php namespace App\Http\Models;

use DB;
use Hash;
use Auth;
use Validator;

class DoorcardImportModel
{
   protected $table = 't_doorcard';

    public function Rules()
    {
        return array(
            'td_dataname' => 'required',                      
        );
    }

    public function Messages()
    {
        return array(
           'td_dataname.required'  => trans('validation.error_td_dataname_required'),
            
        );
    }
    
    public function get_all()
    {
        $results = DB::table($this->table)->distinct('td_dataname')->orderBy('td_id', 'desc')->take(100)->get();//->groupBy('td_dataname')
        return $results;
    }
    
    public function insert($data)
    {
        $results = DB::table($this->table)->insert($data);        
        return $results;
    }
    
    public function get_by_id($id)
    {
        $results = DB::table($this->table)->where('td_id', $id)->first();        
        return $results;
    }   
    
    public function insert_get_id($data)
    {
        return DB::table($this->table)->insertGetId($data);
    } 
    
    public function update($id, $data)
    {
        $results = DB::table($this->table)->where('td_id', $id)->update($data);
        return $results;
    }
    
    public function delete($dataname)
    {
        $results = DB::table($this->table)->where('td_dataname', $dataname)->delete();        
        return $results;
    }

    public static function touchtime($staff=array(), $date=null){
        if(!empty($staff)){
            return DB::table('t_doorcard')
                ->select(DB::raw('min(td_touchtime) as door_in, max(td_touchtime) as door_out'))
                ->whereDate('td_touchtime', $date)
                ->whereNotNull('td_card')
                ->where('td_card', $staff->staff_card1)
                ->orWhereNotNull('td_card')
                ->where('td_card', $staff->staff_card2)
                ->orWhereNotNull('td_card')
                ->where('td_card', $staff->staff_card3)
                ->orWhereNotNull('td_card')
                ->where('td_card', $staff->staff_card4)
                ->orWhereNotNull('td_card')
                ->where('td_card', $staff->staff_card5)
                ->orWhereNotNull('td_card')
                ->where('td_card', $staff->staff_card6)
                ->orWhereNotNull('td_card')
                ->where('td_card', $staff->staff_card7)
                ->orWhereNotNull('td_card')
                ->where('td_card', $staff->staff_card8)
                ->orWhereNotNull('td_card')
                ->where('td_card', $staff->staff_card9)
                ->orWhereNotNull('td_card')
                ->where('td_card', $staff->staff_card10)                
                ->get();
        }

    }

}