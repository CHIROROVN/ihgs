<?php namespace App\Http\Models;

use DB;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class SearchModel extends Model
{
    protected $table   = 't_staff';
     //Search working time
    public static function staffOfWorkTime($staff, $conditions){
        $staff_id_no = $staff->staff_id_no;
        $date_from = date('Y-m-d' , strtotime($conditions['year_from'].'-'.$conditions['month_from'].'-'.'01'));
        $date_to = date('Y-m-d' , strtotime($conditions['year_to'].'-'.$conditions['month_to'].'-' . date('t', strtotime($conditions['year_to'].'-'.$conditions['month_to']))));
        
        $result = array();
        $worktimes = array();
        $day = 86400;
        $format = 'Y-m-d'; 
        $sTime = strtotime($date_from);
        $eTime = strtotime($date_to);
        $numDays = round(($eTime - $sTime) / $day) + 1;

        for ($d = 0; $d < $numDays; $d++) { 
            $dt = date($format, ($sTime + ($d * $day))); 
            $worktimes[$dt]['tt_date'] = date($format, ($sTime + ($d * $day))) . ' 00:00:00'; 
        }
        
        $result['timecard'] = DB::table('t_staff')
        		->leftJoin('t_timecard', function($join){
        			$join->on('t_staff.staff_id_no', '=', 't_timecard.tt_staff_id_no');
        		})

            ->leftJoin('t_pc', function($join) use ($staff){
                $join->on('t_timecard.tt_date', '=', 't_pc.tp_date')
                ->where('t_pc.tp_staff_id_no', $staff->staff_id_no);
            })

        		->select('t_timecard.tt_date', 't_timecard.tt_gotime', 't_timecard.tt_backtime', 't_pc.tp_logintime', 't_pc.tp_logouttime')

                ->where('t_staff.staff_id_no', $staff_id_no)
                ->whereDate('t_timecard.tt_date', '>=', $date_from)
                ->whereDate('t_timecard.tt_date', '<=', $date_to)
                ->orderBy('t_timecard.tt_date', 'asc')
                ->get()->toArray();
        $result['doorcard'] =    DB::table('t_doorcard')
                                    ->select(DB::raw('td_card,td_touchtime')) 
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
                                    })->whereDate('td_touchtime', '>=', $date_from)->whereDate('td_touchtime', '<=', $date_to)->get()->toArray();                                     

        if(count($result['doorcard']) >0){
            foreach ($result['doorcard'] as $key => $value) {
                $tt_date = date('Y-m-d', strtotime($value->td_touchtime));
                if(!isset($doorcard[$tt_date]['door_in'])){
                     $doorcard[$tt_date]['door_in'] = date('H:i:s', strtotime($value->td_touchtime));
                     $doorcard[$tt_date]['door_out'] = date('H:i:s', strtotime($value->td_touchtime)); 
                }else{
                    $door_in    = strtotime($tt_date.' '.$doorcard[$tt_date]['door_in']);
                    $door_out   = strtotime($tt_date.' '.$doorcard[$tt_date]['door_out']);
                    $tempt      = strtotime($value->td_touchtime);
                    $doorcard[$tt_date]['door_in'] = ($tempt <$door_in)?date('H:i:s', strtotime($value->td_touchtime)):$doorcard[$tt_date]['door_in'];
                    $doorcard[$tt_date]['door_out'] = ($tempt >$door_out)?date('H:i:s', strtotime($value->td_touchtime)):$doorcard[$tt_date]['door_out'];
                }                
            }

        }
        
        if(!empty($result['timecard'])){
            foreach ($result['timecard'] as $valtc) {
                $tt_date = date('Y-m-d', strtotime($valtc->tt_date));
                if(array_key_exists($tt_date, $worktimes)){
                    $worktimes[$tt_date] = array('tt_date'=>date('Y-m-d H:i:s', strtotime($valtc->tt_date)), 'tt_gotime'=>$valtc->tt_gotime, 'tt_backtime'=>$valtc->tt_backtime, 'tp_logintime'=>$valtc->tp_logintime, 'tp_logouttime'=>$valtc->tp_logouttime);
                }
            }
        }
        if(count($result['doorcard']) >0){
            foreach($doorcard as $k=>$v){
              if(count($worktimes[$k]) >1){  
                 $worktimes[$k] = array('tt_date'=>date('Y-m-d H:i:s', strtotime($k)), 'door_in'=>$v['door_in'], 'door_out'=>$v['door_out'], 'tt_gotime'=>@$worktimes[$k]['tt_gotime'], 'tt_backtime'=>@$worktimes[$k]['tt_backtime'], 'tp_logintime'=>@$worktimes[$k]['tp_logintime'], 'tp_logouttime'=>@$worktimes[$k]['tp_logouttime']);
              }else{
                 $worktimes[$k] = array('tt_date'=>date('Y-m-d H:i:s', strtotime($k)), 'door_in'=>$v['door_in'], 'door_out'=>$v['door_out']);
              }
                
            }
        }            
        $result['worktimes'] = $worktimes;        
        return $result;
    }

    public static function staffOfWorkOverTime($staff, $conditions){
        $id = $staff->staff_id;
        if((int)($id)<1) return array();
        $yearFrom   = isset($conditions["year_from"])?(int)$conditions["year_from"]:date("Y");
        $yearTo     = isset($conditions["year_to"])?(int)$conditions["year_to"]:date("Y");
        $monthFrom  = isset($conditions["month_from"])?(int)$conditions["month_from"]-1:date("n");
        $monthTo    = isset($conditions["month_to"])?(int)$conditions["month_to"]+1:date("n");
        $arrTempt   = array();            
        $results['doorcards'] = DB::table('t_doorcard')->where(function($query) use ($yearFrom,$yearTo,$monthFrom,$monthTo){
                                          $query->where(function ($query) use ($yearFrom,$yearTo,$monthFrom,$monthTo) {
                                                            $query->whereYear('td_touchtime', $yearFrom)
                                                                  ->whereMonth('td_touchtime','>', $monthFrom);
                                                        })
                                                     ->orWhere(function ($query) use ($yearFrom,$yearTo,$monthFrom,$monthTo){
                                                            $query->whereYear('td_touchtime', $yearTo)
                                                                  ->whereMonth('td_touchtime','<', $monthTo);
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
          
           $results['pcs'] = DB::table('t_staff')->join('t_pc as t1', function ($join) use ($yearFrom,$yearTo,$monthFrom,$monthTo) {
                                                $join->on('t_staff.staff_id_no', '=', 't1.tp_staff_id_no')
                                                     ->Where(function ($query) use ($yearFrom,$yearTo,$monthFrom,$monthTo) {
                                                            $query->whereYear('t1.tp_date', $yearFrom)
                                                                  ->whereMonth('t1.tp_date','>',$monthFrom);
                                                        })
                                                     ->orWhere(function ($query) use ($yearFrom,$yearTo,$monthFrom,$monthTo){
                                                            $query->whereYear('t1.tp_date', $yearTo)
                                                                  ->whereMonth('t1.tp_date','<', $monthTo);
                                                        });                                                     
                                            })                                         
                                          ->where('t_staff.staff_id', $id)->select('t1.tp_date','t1.tp_logintime','t1.tp_logouttime','t1.tp_staff_id_no')->orderBy('t1.tp_date','asc')                                         
                                          ->get();                                                                          
           
           $results['timecards']= DB::table('t_staff')->join('t_timecard as t1', 't_staff.staff_id_no', '=', 't1.tt_staff_id_no')
                                           ->where(function($query) use ($yearFrom,$yearTo,$monthFrom,$monthTo){
                                                $query->where(function ($query) use ($yearFrom,$yearTo,$monthFrom,$monthTo) {
                                                                  $query->whereYear('t1.tt_date', $yearFrom)
                                                                        ->whereMonth('t1.tt_date','>', $monthFrom);
                                                              })
                                                           ->orWhere(function ($query) use ($yearFrom,$yearTo,$monthFrom,$monthTo){
                                                                  $query->whereYear('t1.tt_date', $yearTo)
                                                                        ->whereMonth('t1.tt_date','<', $monthTo);
                                                              });
                                          })
                                          ->where('t_staff.staff_id', $id)->select('t1.tt_date','t1.tt_gotime','t1.tt_backtime','t1.tt_staff_id_no')
                                          ->orderBy('t1.tt_date', 'asc')                                          
                                          ->get();
        if(count($results['timecards']) >0){           
            foreach($results['timecards'] as $val){
                $temptDate     = date("Y-m-d",strtotime($val->tt_date));                                                
                $arrTempt[$temptDate]['gotime']   = (!isset($arrTempt[$temptDate]['gotime']))?date("H:i:s",strtotime($val->tt_gotime)):date("H:i:s",strtotime(compare_min($arrTempt[$temptDate]['gotime'],$val->tt_gotime)));
                $arrTempt[$temptDate]['backtime'] = (!isset($arrTempt[$temptDate]['backtime']))?date("H:i:s",strtotime($val->tt_backtime)):date("H:i:s",strtotime(compare_max($val->tt_backtime,$arrTempt[$temptDate]['backtime'])));                                          
            }           
        }               
        
        if(count($results['doorcards']) >0){                   
            foreach($results['doorcards'] as $val){
                $temptDate = date("Y-m-d",strtotime($val->td_touchtime));
                if(isset($arrTempt[$temptDate])){
                    if(!isset($arrTempt[$temptDate]['touchtime_in']))
                    {
                        $arrTempt[$temptDate]['touchtime_in'] = date("H:i:s",strtotime($val->td_touchtime));
                        $arrTempt[$temptDate]['touchtime_out'] = date("H:i:s",strtotime($val->td_touchtime));
                    }else{
                        $temptDateIn     = strtotime($temptDate.' '.$arrTempt[$temptDate]['touchtime_in']);
                        $temptDateOut    = strtotime($temptDate.' '.$arrTempt[$temptDate]['touchtime_out']);
                        $temptDateSource = strtotime($val->td_touchtime);
                        if($temptDateSource < $temptDateIn)
                            $arrTempt[$temptDate]['touchtime_in'] = date("H:i:s",strtotime($val->td_touchtime));
                        if($temptDateSource > $temptDateOut)
                            $arrTempt[$temptDate]['touchtime_out'] = date("H:i:s",strtotime($val->td_touchtime));
                    } 
                }else{
                    $arrTempt[$temptDate]['touchtime_in'] = date("H:i:s",strtotime($val->td_touchtime));
                    $arrTempt[$temptDate]['touchtime_out'] = date("H:i:s",strtotime($val->td_touchtime));
                }               
            }   
        }
        if(count($results['pcs']) >0){                     
            foreach($results['pcs'] as $val){
                $temptDate = date("Y-m-d",strtotime($val->tp_date));                
                $arrTempt[$temptDate]['pc_in']  = (!isset($arrTempt[$temptDate]['pc_in']))?date("H:i:s",strtotime($val->tp_logintime)):date("H:i:s",strtotime(compare_min($val->tp_logintime, $arrTempt[$temptDate]['pc_in'])));
                $arrTempt[$temptDate]['pc_out'] = (!isset($arrTempt[$temptDate]['pc_out']))?date("H:i:s",strtotime($val->tp_logouttime)): date("H:i:s",strtotime(compare_max($arrTempt[$temptDate]['pc_out'], $val->tp_logouttime)));           
            }   
        }   
        $arrResult = array();$intMonth =1;     
        for($i=$yearFrom;$i<=$yearTo;$i++){            
            $startMonth = ($i==$yearFrom)?$monthFrom+1:1;            
            $endMonth   = ($i==$yearFrom && $yearFrom<$yearTo)?12:$monthTo-1;
            for($j=$startMonth;$j<=$endMonth;$j++){
                $endDate = date("t",mktime(0,0,0,$j,1,$i));                 
                for($k=1;$k<=$endDate;$k++){
                    $strDate = date("Y-m-d",mktime(0,0,0,$j,$k,$i));                    
                    $arrResult[$intMonth][$strDate] = (array_key_exists($strDate,$arrTempt))?$arrTempt[$strDate]:array();
                }
                $intMonth++;

            }
        }

        return $arrResult;
       
    }    

}