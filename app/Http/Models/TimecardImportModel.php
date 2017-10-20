<?php namespace App\Http\Models;

use DB;
use Validator;

class TimecardImportModel
{
   
   protected $table = 't_timecard';

    public function Rules()
    {
        return array(
            'tt_dataname' => 'required',
            'file_csv'               => 'required|mimes:csv,xls,xlsx', 
        );
    }

    public function Messages()
    {
        return array(
            'tt_dataname.required'  => trans('validation.error_tt_dataname_required'),
            'file_csv.required'      => trans('validation.error_file_path_required'),
            'file_csv.mimes'         => trans('validation.error_timecard_file_csv'),
        );
    }
    
    public function get_all()
    {
        $results = DB::table($this->table)->orderBy('tt_id', 'desc')->get();
        return $results;
    }
     public function get_all_by_dataname()
    {
        $results = DB::table($this->table)->select('tt_dataname', 'last_date')->distinct('tt_dataname')->get();       
        return $results;
    }
    public function getList($staff_id,$year,$month)
    {
        $results1 = DB::table('t_staff')->where('staff_id', $staff_id)->first();              
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
            $results['doorcards'] = DB::table('t_doorcard')->whereIn('td_card',[array_values($strCard)])->whereYear('td_touchtime','=', $year)->whereMonth('td_touchtime','=', $month)->orderBy('td_touchtime', 'asc')->get();
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
            $results['pcs'] = DB::table('t_pc')->whereIn('tp_pc_no',[array_values($strPC)])->whereYear('tp_actiontime','=', $year)->whereMonth('tp_actiontime','=', $month)->orderBy('tp_actiontime', 'asc')->get();
           
        } 

        $results['timecards'] = DB::table('t_staff')->leftJoin('t_timecard as t1', 't_staff.staff_id_no', '=', 't1.tt_staff_id_no')
                                       ->whereYear('t1.tt_date', $year)
                                       ->whereMonth('t1.tt_date','=', $month)
                                       ->where('t_staff.staff_id', $staff_id)->orderBy('t1.tt_date', 'asc')->orderBy('t1.tt_gotime', 'asc')
                                       ->get();

        return $results;                     
       
    }

    public function insert($data)
    {
        $results = DB::table($this->table)->insert($data);
        return $results;
    }
     public function delete($dataname)
    {        
        $results = DB::table($this->table)->where('tt_dataname', $dataname)->delete();        
        return $results;

    }      

}