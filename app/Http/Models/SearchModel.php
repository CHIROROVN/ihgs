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
    public static function staffOfWorkTime($staff_id_no, $conditions){
        $date_from = date('Y-m-d' , strtotime($conditions['year_from'].'-'.$conditions['month_from'].'-'.'01'));
        $date_to = date('Y-m-d' , strtotime($conditions['year_to'].'-'.$conditions['month_to'].'-' . date('t', strtotime($conditions['year_to'].'-'.$conditions['month_to']))));
        $result = array();
        $worktimes = array();
        $result['timecard'] = DB::table('t_staff')
        		->leftJoin('t_timecard', function($join){
        			$join->on('t_staff.staff_id_no', '=', 't_timecard.tt_staff_id_no');
        		})                               
        		->select('t_timecard.tt_date', 't_timecard.tt_gotime', 't_timecard.tt_backtime')
                ->where('t_staff.staff_id_no', $staff_id_no)
                ->whereDate('t_timecard.tt_date', '>=', $date_from)
                ->whereDate('t_timecard.tt_date', '<=', $date_to)
                ->orderBy('t_timecard.tt_date', 'asc')
                ->get()->toArray();

        for($y=$conditions['year_from']; $y<=$conditions['year_to']; $y++){
            for($m=$conditions['month_from']; $m<=$conditions['month_to']; $m++){
                $dayOfMonth = date('t',strtotime($y.'-'.$m));
                for($i=1; $i<=$dayOfMonth; $i++){
                    $ymd_tmp = $y.'-'.c2digit($m) . '-' . c2digit($i);
                   $worktimes[$ymd_tmp]['tt_date'] =  $ymd_tmp;
                }                
            }
        }

        if(!empty($result['timecard'])){
            foreach ($result['timecard'] as $valtc) {
                $tt_date = date('Y-m-d', strtotime($valtc->tt_date));
                if(array_key_exists($tt_date, $worktimes)){
                    $worktimes[$tt_date] = array('tt_date'=>$tt_date, 'tt_gotime'=>$valtc->tt_gotime, 'tt_backtime'=>$valtc->tt_backtime);
                }
            }
        }

        $result['worktimes'] = $worktimes;

        return $result;
    }

}