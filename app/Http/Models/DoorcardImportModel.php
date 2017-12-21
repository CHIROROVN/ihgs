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
            'file_csv'               => 'required|mimes:csv,xls,xlsx',                      
        );
    }

    public function Messages()
    {
        return array(
           'td_dataname.required'  => trans('validation.error_td_dataname_required'),
           'file_csv.required'      => trans('validation.error_file_path_required'),
           'file_csv.mimes'         => trans('validation.error_timecard_file_csv'), 
        );
    }
    
    public function get_all()
    {
        $results = DB::table($this->table)->distinct('td_dataname')->orderBy('td_id', 'desc')->take(100)->get();//->groupBy('td_dataname')
       
        return $results;
    }

    public function get_all_by_dataname()
    {            
        $results = DB::table($this->table)
               ->select(DB::raw('td_dataname, max(last_date) as last_date'))
               ->groupBy('td_dataname')              
               ->get();             
        return  $results;
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
       // DB::enableQueryLog();
        $results = DB::table($this->table)->where('td_dataname', $dataname)->delete();    
       //dd(DB::getQueryLog());
        return $results;
    }

    public static function touchtime($staff=array(), $date=null){
        if(!empty($staff)){
            $sql = DB::table('t_doorcard')
                ->select(DB::raw('min(td_touchtime) as door_in, max(td_touchtime) as door_out'))
                ->whereDate('td_touchtime', $date)
                ->where( function($query) use ($staff){
                    $query->orWhere('td_card', $staff->staff_card1)
                           ->orWhere('td_card', $staff->staff_card2)
                           ->orWhere('td_card', $staff->staff_card3)
                           ->orWhere('td_card', $staff->staff_card4)
                           ->orWhere('td_card', $staff->staff_card5)
                           ->orWhere('td_card', $staff->staff_card6)
                           ->orWhere('td_card', $staff->staff_card7)
                           ->orWhere('td_card', $staff->staff_card8)
                           ->orWhere('td_card', $staff->staff_card9)
                           ->orWhere('td_card', $staff->staff_card10);
                });
            
            return $sql->first();
        }

    }

}