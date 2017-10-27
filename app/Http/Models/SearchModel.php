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
        		->leftJoin('t_timecard', function($join){
        			$join->on('t_staff.staff_id_no', '=', 't_timecard.tt_staff_id_no');
        		})        		
        		->select('t_timecard.tt_date', 't_timecard.tt_gotime', 't_timecard.tt_backtime')
                ->where('t_staff.staff_id_no', $staff_id_no)
                ->where(function($query) use ($conditions){
                    $query->whereYear('t_timecard.tt_date', '>=', $conditions['year_from'])
                            ->whereMonth('t_timecard.tt_date', '>=' , $conditions['month_from']);
                    $query->whereYear('t_timecard.tt_date', '>=', $conditions['year_to'])
                            ->whereMonth('t_timecard.tt_date', '>=' , $conditions['month_to]);
                })
                ->orderBy('t_timecard.tt_date', 'asc');

        return $sql->get();
    }

}