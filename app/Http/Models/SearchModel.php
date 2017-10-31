<?php namespace App\Http\Models;

use DB;
use Hash;
use Auth;
use Validator;
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

                ->leftJoin('t_pc', function($query) use ($staff){
                    $query->where('t_pc.tp_staff_id_no', $staff->staff_id_no);
                            //->whereDate('t_pc.tp_date', 't_timecard.tt_date');
                })

        		->select('t_timecard.tt_date', 't_timecard.tt_gotime', 't_timecard.tt_backtime', 't_pc.tp_logintime', 't_pc.tp_logouttime')

                ->where('t_staff.staff_id_no', $staff_id_no)
                ->whereDate('t_timecard.tt_date', '>=', $date_from)
                ->whereDate('t_timecard.tt_date', '<=', $date_to)
                ->orderBy('t_timecard.tt_date', 'asc')
                ->get()->toArray();

        if(!empty($result['timecard'])){
            foreach ($result['timecard'] as $valtc) {
                $tt_date = date('Y-m-d', strtotime($valtc->tt_date));
                if(array_key_exists($tt_date, $worktimes)){
                    $worktimes[$tt_date] = array('tt_date'=>date('Y-m-d H:i:s', strtotime($valtc->tt_date)), 'tt_gotime'=>$valtc->tt_gotime, 'tt_backtime'=>$valtc->tt_backtime, 'tp_logintime'=>$valtc->tp_logintime, 'tp_logouttime'=>$valtc->tp_logouttime);
                }
            }
        }

        $result['worktimes'] = $worktimes;

        return $result;
    }

}