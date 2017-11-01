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
        //if(!empty($belong_id))     $results = $results->where('staff_belong',  '=', $belong_id);     
        if(!empty($belong_id)){
              $results = $results->Where(function ($query) use ($belong_id) {
                                                            $query->where('m_belong.belong_id',  '=', $belong_id)
                                                                  ->orWhere('m_belong.belong_parent_id','=', $belong_id);
                                                        });
                   
        }             

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

        $results = DB::table($this->table)->join('t_timecard as t1', 't_staff.staff_id_no', '=', 't1.tt_staff_id_no')
                                           ->where(function($query) use ($year){
                                                $query->where(function ($query) use ($year) {
                                                                  $query->whereYear('t1.tt_date', $year)
                                                                        ->whereMonth('t1.tt_date','>', '3');
                                                              })
                                                           ->orWhere(function ($query) use ($year){
                                                                  $query->whereYear('t1.tt_date', $year + 1)
                                                                        ->whereMonth('t1.tt_date','<', '4');
                                                              });
                                          })
                                          ->where('t_staff.staff_id', $id)->select('t1.tt_date','t1.tt_gotime','t1.tt_backtime','t1.tt_staff_id_no')
                                          ->orderBy('t1.tt_date', 'asc')                                          
                                          ->get();                                                 

        return $results;
    }
    
    public function get_doorcard($id,$year)
    {
       $results1 = DB::table('t_staff')->where('staff_id', $id)->first();              
        $strCard = array();   $strPC = array();
        if(isset($results1->staff_id)){
            $results['staff'] = $results1;  
            $results['doorcards'] = DB::table('t_doorcard')->where(function($query) use ($year){
                                          $query->where(function ($query) use ($year) {
                                                            $query->whereYear('td_touchtime', $year)
                                                                  ->whereMonth('td_touchtime','>', '3');
                                                        })
                                                     ->orWhere(function ($query) use ($year){
                                                            $query->whereYear('td_touchtime', $year + 1)
                                                                  ->whereMonth('td_touchtime','<', '4');
                                                        });
                                    
                                    })->where(function($query) use ($id){
                                        $query->whereIn('td_card',function ($query) use ($id) {
                                              $query->select('staff_card1')->from('t_staff')
                                              ->where('staff_card1','<>','')->where('staff_id','=',$id);
                                        });   
                                        for($i=2;$i<=10;$i++){                                     
                                            $query->orWhereIn('td_card',function ($query) use ($i,$id)  {
                                                  $query->select('staff_card'.$i)->from('t_staff')
                                                  ->where('staff_card'.$i,'<>','')->where('staff_id','=',$id);
                                            });
                                        }                                            
                                    })->select('td_card','td_door','td_touchtime')->orderBy('td_touchtime', 'asc')->get();                                                                                                                                          
          
           $results['pcs'] = DB::table($this->table)->join('t_pc as t1', function ($join) use ($year) {
                                                $join->on('t_staff.staff_id_no', '=', 't1.tp_staff_id_no')
                                                     ->Where(function ($query) use ($year) {
                                                            $query->whereYear('t1.tp_date', $year)
                                                                  ->whereMonth('t1.tp_date','>', '3');
                                                        })
                                                     ->orWhere(function ($query) use ($year){
                                                            $query->whereYear('t1.tp_date', $year + 1)
                                                                  ->whereMonth('t1.tp_date','<', '4');
                                                        });                                                     
                                            })                                         
                                          ->where('t_staff.staff_id', $id)->select('t1.tp_date','t1.tp_logintime','t1.tp_logouttime','t1.tp_staff_id_no')->orderBy('t1.tp_date','asc')                                         
                                          ->get();                                                                          
           
           $results['timecards']= DB::table($this->table)->join('t_timecard as t1', 't_staff.staff_id_no', '=', 't1.tt_staff_id_no')
                                           ->where(function($query) use ($year){
                                                $query->where(function ($query) use ($year) {
                                                                  $query->whereYear('t1.tt_date', $year)
                                                                        ->whereMonth('t1.tt_date','>', '3');
                                                              })
                                                           ->orWhere(function ($query) use ($year){
                                                                  $query->whereYear('t1.tt_date', $year + 1)
                                                                        ->whereMonth('t1.tt_date','<', '4');
                                                              });
                                          })
                                          ->where('t_staff.staff_id', $id)->select('t1.tt_date','t1.tt_gotime','t1.tt_backtime','t1.tt_staff_id_no')
                                          ->orderBy('t1.tt_date', 'asc')                                          
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

                                  