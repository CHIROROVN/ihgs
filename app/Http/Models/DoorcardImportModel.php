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
        $arrResult = array();
        $results = DB::table($this->table)->select(DB::raw('DISTINCT(td_dataname) , last_date'))->get();
        if(count($results) >0){
            foreach($results as $value){
               $arrResult[$value->td_dataname] = $value->last_date;
            }            
        }
        return  $arrResult;
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
            $sql = DB::table('t_doorcard')
                ->select(DB::raw('min(td_touchtime) as door_in, max(td_touchtime) as door_out'))
                ->whereDate('td_touchtime', $date);
            if(!empty($staff->staff_card1)){
                $sql =  $sql->whereNotNull('td_card')
                ->where('td_card', $staff->staff_card1);
            }
            if(!empty($staff->staff_card2)){
                $sql =  $sql->whereNotNull('td_card')
                ->where('td_card', $staff->staff_card2);
            }
            if(!empty($staff->staff_card3)){
                $sql =  $sql->whereNotNull('td_card')
                ->where('td_card', $staff->staff_card3);
            }
            if(!empty($staff->staff_card4)){
                $sql =  $sql->whereNotNull('td_card')
                ->where('td_card', $staff->staff_card4);
            }
            if(!empty($staff->staff_card5)){
                $sql =  $sql->whereNotNull('td_card')
                ->where('td_card', $staff->staff_card5);
            }
            if(!empty($staff->staff_card6)){
                $sql =  $sql->whereNotNull('td_card')
                ->where('td_card', $staff->staff_card6);
            }
            if(!empty($staff->staff_card7)){
                $sql =  $sql->whereNotNull('td_card')
                ->where('td_card', $staff->staff_card7);
            }
            if(!empty($staff->staff_card8)){
                $sql =  $sql->whereNotNull('td_card')
                ->where('td_card', $staff->staff_card8);
            }
            if(!empty($staff->staff_card9)){
                $sql =  $sql->whereNotNull('td_card')
                ->where('td_card', $staff->staff_card9);
            }
            if(!empty($staff->staff_card10)){
                $sql =  $sql->whereNotNull('td_card')
                ->where('td_card', $staff->staff_card10);
            }
               
            return $sql->get();
        }

    }

}