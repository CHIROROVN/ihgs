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
                                          ->where('t_staff.staff_id', $id)->select('tt_date','tt_gotime','tt_backtime','tt_staff_id_no')                                          
                                          ->get();         

        return $results;
    }
    
    public function get_doorcard($id,$year)
    {
       $results1 = DB::table('t_staff')->where('staff_id', $id)->first();              
        $strCard = array();   $strPC = array();
        if(isset($results1->staff_id)){
            $results['staff'] = $results1;  
            if(!empty($results1->staff_card1))  $strCard[] = $results1->staff_card1;
            if(!empty($results1->staff_card2))  $strCard[] = $results1->staff_card2;
            if(!empty($results1->staff_card3))  $strCard[] = $results1->staff_card3;
            if(!empty($results1->staff_card4))  $strCard[] = $results1->staff_card4;
            if(!empty($results1->staff_card5))  $strCard[] = $results1->staff_card5;
            if(!empty($results1->staff_card6))  $strCard[] = $results1->staff_card6;
            if(!empty($results1->staff_card7))  $strCard[] = $results1->staff_card7;
            if(!empty($results1->staff_card8))  $strCard[] = $results1->staff_card8;
            if(!empty($results1->staff_card9))  $strCard[] = $results1->staff_card9;
            if(!empty($results1->staff_card10))  $strCard[] = $results1->staff_card10; 
            if(count($strCard) >0)                      
              $results['doorcards'] = DB::table('t_doorcard')->where(function($query) use ($year){
                                          $query->where(function ($query) use ($year) {
                                                            $query->whereYear('td_touchtime', $year)
                                                                  ->whereMonth('td_touchtime','>', '3');
                                                        })
                                                     ->orWhere(function ($query) use ($year){
                                                            $query->whereYear('td_touchtime', $year + 1)
                                                                  ->whereMonth('td_touchtime','<', '4');
                                                        });
                                    })->whereIn('td_card',[array_values($strCard)])->orderBy('td_touchtime', 'asc')->get();
            else $results['doorcards'] = array();
                                   
           if(!empty($results1->staff_pc1))  $strPC[] = $results1->staff_pc1;
            if(!empty($results1->staff_pc2))  $strPC[] = $results1->staff_pc2;
            if(!empty($results1->staff_pc3))  $strPC[] = $results1->staff_pc3;
            if(!empty($results1->staff_pc4))  $strPC[] = $results1->staff_pc4;
            if(!empty($results1->staff_pc5))  $strPC[] = $results1->staff_pc5;
            if(!empty($results1->staff_pc6))  $strPC[] = $results1->staff_pc6;
            if(!empty($results1->staff_pc7))  $strPC[] = $results1->staff_pc7;
            if(!empty($results1->staff_pc8))  $strPC[] = $results1->staff_pc8;
            if(!empty($results1->staff_pc9))  $strPC[] = $results1->staff_pc9;
            if(!empty($results1->staff_pc10)) $strPC[] = $results1->staff_pc10;
            if(count($strPC) >0)                       
            $results['pcs'] = DB::table('t_pc')->whereIn('tp_pc_no',[array_values($strPC)])->where(function($query) use ($year){
                                          $query->where(function ($query) use ($year) {
                                                            $query->whereYear('tp_actiontime', $year)
                                                                  ->whereMonth('tp_actiontime','>', '3');
                                                        })
                                                     ->orWhere(function ($query) use ($year){
                                                            $query->whereYear('tp_actiontime', $year + 1)
                                                                  ->whereMonth('tp_actiontime','<', '4');
                                                        });
                                    })->orderBy('tp_actiontime', 'asc')->get();
            else  $results['pcs'] = array();
            $results['timecards'] = DB::table($this->table)->join('t_timecard as t1', function ($join) use ($year) {
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
           
        }        

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