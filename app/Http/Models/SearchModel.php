<?php namespace App\Http\Models;

use DB;
use Hash;
use Auth;
use Validator;
use Illuminate\Database\Eloquent\Model;

class SearchModel extends Model
{
    protected $table   = 't_staff';

     //Search working time
    public static function staffOfWorkTime($staff_id_no, $conditions){

        $sql = DB::table('t_staff')
        		//->leftJoin('t_pc', function($join){
        		// 	$join->on('t_staff.staff_id_no', '=', 't_pc.tp_pc_no')
        		// 	->orOn('t_staff.staff_pc1', '=', 't_pc.tp_pc_no')
        		// 	->orOn('t_staff.staff_pc2', '=', 't_pc.tp_pc_no')
        		// 	->orOn('t_staff.staff_pc3', '=', 't_pc.tp_pc_no')
        		// 	->orOn('t_staff.staff_pc4', '=', 't_pc.tp_pc_no')
        		// 	->orOn('t_staff.staff_pc5', '=', 't_pc.tp_pc_no')
        		// 	->orOn('t_staff.staff_pc6', '=', 't_pc.tp_pc_no')
        		// 	->orOn('t_staff.staff_pc7', '=', 't_pc.tp_pc_no')
        		// 	->orOn('t_staff.staff_pc8', '=', 't_pc.tp_pc_no')
        		// 	->orOn('t_staff.staff_pc9', '=', 't_pc.tp_pc_no')
        		// 	->orOn('t_staff.staff_pc10', '=', 't_pc.tp_pc_no');
        		// })
        		// ->leftJoin('t_doorcard', function($join){
        		// 	$join->on('t_staff.staff_card1', '=', 't_doorcard.td_card')
        		// 	->orOn('t_staff.staff_card2', '=', 't_doorcard.td_card')
        		// 	->orOn('t_staff.staff_card3', '=', 't_doorcard.td_card')
        		// 	->orOn('t_staff.staff_card4', '=', 't_doorcard.td_card')
        		// 	->orOn('t_staff.staff_card5', '=', 't_doorcard.td_card')
        		// 	->orOn('t_staff.staff_card6', '=', 't_doorcard.td_card')
        		// 	->orOn('t_staff.staff_card7', '=', 't_doorcard.td_card')
        		// 	->orOn('t_staff.staff_card8', '=', 't_doorcard.td_card')
        		// 	->orOn('t_staff.staff_card9', '=', 't_doorcard.td_card')
        		// 	->orOn('t_staff.staff_card10', '=', 't_doorcard.td_card');
        		// })
        		->leftJoin('t_timecard', function($join){
        			$join->on('t_staff.staff_id_no', '=', 't_timecard.tt_staff_id_no');
        		})
        		
        		->select('t_timecard.tt_date', 't_timecard.tt_gotime', 't_timecard.tt_backtime')
                ->where('t_staff.staff_id_no', $staff_id_no);

        if(!empty($conditions['year_from'])){
        	$sql = $sql->whereYear('t_timecard.tt_date', '>=' , $conditions['year_from']);
        }

         if(!empty($conditions['month_from'])){
        	$sql = $sql->whereMonth('t_timecard.tt_date', '>=' , $conditions['month_from']);
        }

        if(!empty($conditions['year_to'])){
        	$sql = $sql->whereYear('t_timecard.tt_date', '<=' , $conditions['year_to']);
        }

         if(!empty($conditions['month_to'])){
        	$sql = $sql->whereMonth('t_timecard.tt_date', '<=' , $conditions['month_to']);
        }

        return $sql->get();
    }

}