<?php namespace App\Http\Models;

use DB;
use Hash;
use Auth;
use Validator;

class SearchModel
{
    protected $table   = 't_staff';

     //Search working time
    public function staffOfWorkTime($where=null){
        $sql = DB::table($this->table)
        		->leftJoin('t_pc', function($join){
        			$join->on('t_staff.staff_id_no', '=', 't_pc.tp_pc_no')
        			->orOn('t_staff.staff_pc1', '=', 't_pc.tp_pc_no')
        			->orOn('t_staff.staff_pc2', '=', 't_pc.tp_pc_no')
        			->orOn('t_staff.staff_pc3', '=', 't_pc.tp_pc_no')
        			->orOn('t_staff.staff_pc4', '=', 't_pc.tp_pc_no')
        			->orOn('t_staff.staff_pc5', '=', 't_pc.tp_pc_no')
        			->orOn('t_staff.staff_pc6', '=', 't_pc.tp_pc_no')
        			->orOn('t_staff.staff_pc7', '=', 't_pc.tp_pc_no')
        			->orOn('t_staff.staff_pc8', '=', 't_pc.tp_pc_no')
        			->orOn('t_staff.staff_pc9', '=', 't_pc.tp_pc_no')
        			->orOn('t_staff.staff_pc10', '=', 't_pc.tp_pc_no');
        		})
        		->leftJoin('t_doorcard', function($join){
        			$join->on('t_staff.staff_pc1', '=', 't_doorcard.td_card')
        			->orOn('t_staff.staff_pc2', '=', 't_doorcard.td_card')
        			->orOn('t_staff.staff_pc3', '=', 't_doorcard.td_card')
        			->orOn('t_staff.staff_pc4', '=', 't_doorcard.td_card')
        			->orOn('t_staff.staff_pc5', '=', 't_doorcard.td_card')
        			->orOn('t_staff.staff_pc6', '=', 't_doorcard.td_card')
        			->orOn('t_staff.staff_pc7', '=', 't_doorcard.td_card')
        			->orOn('t_staff.staff_pc8', '=', 't_doorcard.td_card')
        			->orOn('t_staff.staff_pc9', '=', 't_doorcard.td_card')
        			->orOn('t_staff.staff_pc10', '=', 't_doorcard.td_card');
        		})
        		->leftJoin('t_timecard', function($join){
        			$join->on('t_staff.staff_id_no', '=', 't_timecard.tt_staff_id_no')
        			->orOn('t_staff.staff_card1', '=', 't_timecard.tt_staff_id_no')
        			->orOn('t_staff.staff_card2', '=', 't_timecard.tt_staff_id_no')
        			->orOn('t_staff.staff_card3', '=', 't_timecard.tt_staff_id_no')
        			->orOn('t_staff.staff_card4', '=', 't_timecard.tt_staff_id_no')
        			->orOn('t_staff.staff_card5', '=', 't_timecard.tt_staff_id_no')
        			->orOn('t_staff.staff_card6', '=', 't_timecard.tt_staff_id_no')
        			->orOn('t_staff.staff_card7', '=', 't_timecard.tt_staff_id_no')
        			->orOn('t_staff.staff_card8', '=', 't_timecard.tt_staff_id_no')
        			->orOn('t_staff.staff_card9', '=', 't_timecard.tt_staff_id_no')
        			->orOn('t_staff.staff_card10', '=', 't_timecard.tt_staff_id_no');
        		})

        		//->join('t_pc', 't_staff.staff_id_no', 't_pc.tp_pc_no')

        		//->join('t_timecard', 't_staff.staff_id_no', 't_timecard.tt_staff_id_no')
        		
        		->select('t_staff.*', 't_timecard.tt_date', 't_timecard.tt_gotime', 't_timecard.tt_backtime')
        		->where('t_staff.last_kind', '<>', DELETE);

                //->leftJoin('t_staff', 'm_belong.belong_id', '=', 't_staff.staff_belong')
                //->leftJoin('t_timecard', 't_staff.staff_id_no', 't_timecard.tt_staff_id_no')
                //->leftJoin('t_pc', 't_staff.staff_id_no', 't_pc.tp_id')
                //->leftJoin('t_pc', 't_staff.staff_id_no', 't_pc.tp_pc_no')
                // ->select('m_belong.belong_id', 'm_belong.belong_name', 't_staff.*', 't_timecard.tt_date', 't_timecard.tt_gotime', 't_timecard.tt_backtime')
                // ->where('m_belong.last_kind', '<>', DELETE)
                // ->where('t_staff.last_kind', '<>', DELETE);

        if(!empty($where['belong_id'])){
            $sql = $sql->where('t_staff.staff_belong', $where['belong_id']);
        }

        if(!empty($where['year_from'])){
        	$sql = $sql->whereYear('t_timecard.tt_date', '>=' , $where['year_from']);
        }

         if(!empty($where['month_from'])){
        	$sql = $sql->whereMonth('t_timecard.tt_date', '>=' , $where['month_from']);
        }

        if(!empty($where['year_to'])){
        	$sql = $sql->whereYear('t_timecard.tt_date', '<=' , $where['year_to']);
        }

         if(!empty($where['month_to'])){
        	$sql = $sql->whereMonth('t_timecard.tt_date', '>=' , $where['month_to']);
        }

        if(!empty($where['kw'])){
            $sql = $sql->where('t_staff.staff_id_no', $where['kw'])->orWhere('t_staff.staff_name', 'like', '%'.$where['kw'].'%');
        }

        return $sql->get();
    }

}