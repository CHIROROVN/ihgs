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

        $results = DB::table($this->table)->join('m_belong', 't_staff.staff_belong', '=', 'm_belong.belong_id')                                                                                  
                                          ->where('t_staff.staff_id', $id)                                          
                                          ->first();         

        return $results;
    }

    public function get_timecard($id,$year)
    {

        $results = DB::table($this->table)->join('t_timecard as t1', function ($join) use ($year) {
                                                $join->on('t_staff.staff_id_no', '=', 't1.tt_staff_id_no')
                                                     ->Where(function ($query) use ($year) {
                                                            $query->whereYear('t1.tt_date', $year)
                                                                  ->whereMonth('t1.tt_date','>', '3');
                                                        })
                                                     ->orWhere(function ($query) use ($year){
                                                            $query->whereYear('t1.tt_date', $year + 1)
                                                                  ->whereMonth('t1.tt_date','<', '4');
                                                        });                                                     
                                            })                                         
                                          ->where('t_staff.staff_id', $id)                                          
                                          ->get();         

        return $results;
    }
    public function get_doorcard($id,$year)
    {
        $results = DB::table('t_staff')->join('t_doorcard', function ($join) {
                                                $join->on('t_staff.staff_card1', '=', 't_doorcard.td_card');
                                                    /* ->orOn('t_staff.staff_card2', '=', 't_doorcard.td_card')
                                                     ->orOn('t_staff.staff_card3', '=', 't_doorcard.td_card')
                                                     ->orOn('t_staff.staff_card4', '=', 't_doorcard.td_card')
                                                     ->orOn('t_staff.staff_card5', '=', 't_doorcard.td_card')
                                                     ->orOn('t_staff.staff_card6', '=', 't_doorcard.td_card')
                                                     ->orOn('t_staff.staff_card7', '=', 't_doorcard.td_card')
                                                     ->orOn('t_staff.staff_card8', '=', 't_doorcard.td_card')
                                                     ->orOn('t_staff.staff_card9', '=', 't_doorcard.td_card')
                                                     // ->orOn('t_staff.staff_card10', '=', 't_doorcard.td_card');*/
                                            })   
                                            ->Where(function ($query) use ($year){
                                                            $query->whereYear('t_doorcard.td_touchtime', $year)
                                                                  ->whereMonth('t_doorcard.td_touchtime','>', '3');
                                                        })
                                                     ->orWhere(function ($query) use ($year){
                                                            $query->whereYear('t_doorcard.td_touchtime', $year + 1)
                                                                  ->whereMonth('t_doorcard.td_touchtime','<', '4');
                                            })->where('t_staff.staff_id', $id)                                        
                                            ->get();         

        return $results;
    }
    public function get_doorcard_by_card($strCard,$year)
    {
       $results = DB::table('t_doorcard')->whereIn('td_card', [$strCard])
                                        ->Where(function ($query) use ($year) {
                                                            $query->whereYear('t_doorcard.td_touchtime', $year)
                                                                  ->whereMonth('t_doorcard.td_touchtime','>', '3');
                                                        })
                                                     ->orWhere(function ($query) {
                                                            $query->whereYear('t_doorcard.td_touchtime', $year + 1)
                                                                  ->whereMonth('t_doorcard.td_touchtime','<', '4');
                                        })->get();  
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