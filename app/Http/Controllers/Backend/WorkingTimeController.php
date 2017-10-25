<?php namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Backend\BackendController;
use App\Http\Models\WorkingTimeModel;
use App\Http\Models\BelongModel;
use Input;
use Validator;
use Session;
use PDF;


class WorkingTimeController extends BackendController
{
	public function index(){
		$data                 = array();
        $inputs               = Input::all();                
		$clsWorkingTime       = new WorkingTimeModel();
		$clsBelong            = new BelongModel();
		$data['staff_belong'] = (count($inputs) >0)?Input::get('staff_belong', null):'';
		$data['cb_year']      = (count($inputs) >0)?Input::get('cb_year', null):'';
		$data['worktimes']    = (count($inputs) >0)?$clsWorkingTime->get_all($data['staff_belong'],$data['cb_year'] ):array();
		$data['error']['error_belong_required']  = trans('validation.error_belong_required');
        $data['error']['error_year_required']    = trans('validation.error_year_required');
		$arrWorkTime = array(); 
		if(count($data['worktimes']) >0){
			foreach($data['worktimes']['data'] as $worktime){				
				$arrWorkTime[$worktime->staff_id]  =  $this->get_over_time_year($worktime->staff_id,$data['cb_year']);
				$total =0;$intOverTime =0;
				if(count($arrWorkTime[$worktime->staff_id])>0){
					foreach($arrWorkTime[$worktime->staff_id] as $key=>$val){
						$data['overtimes'][$worktime->staff_id][$key] = round($val /3600);
						$intOverTime +=($data['overtimes'][$worktime->staff_id][$key] >60)?1:0;
						$total += $val;
					}
					$data['overtimes'][$worktime->staff_id]['total']   = round($total/3600); 
					$data['overtimes'][$worktime->staff_id]['time']    = $intOverTime;
				}			
			}						
		}			
		return view('backend.workingtime.index',$data);
	}

	public function detail($id){
		$clsWorkingTime   = new WorkingTimeModel();
        $data['year']     = (isset($_GET['year']) && $_GET['year'] >2000)?$_GET['year']:date("Y");
		$data['staff']    =  $clsWorkingTime->get_by_id($id);		
		$arrTempt         = $this->get_work_time_array($id, $data['year'] );			
		$data['worktimes']  = $arrTempt;
		
		return view('backend.workingtime.detail',$data);
	}

	public function exportPDF()
	{
	   $clsWorkingTime   = new WorkingTimeModel();
	   $clsBelong            = new BelongModel();
	   $data = array();

		$data['staff_belong'] 	= !empty(Input::get('staff_belong')) ? Input::get('staff_belong') : null;
		$data['cb_year'] 		= !empty(Input::get('cb_year')) ? Input::get('cb_year') : null ;
		$data['worktimes']    	= $clsWorkingTime->get_all( $data['staff_belong'], $data['cb_year'] );
		$arrWorkTime = array(); 
		if(count($data['worktimes']) >0){
			foreach($data['worktimes']['data'] as $worktime){				
				$arrWorkTime[$worktime->staff_id]  =  $this->get_over_time_year($worktime->staff_id,$data['cb_year']);
				$total =0;$intOverTime =0;
				if(count($arrWorkTime[$worktime->staff_id])>0){
					foreach($arrWorkTime[$worktime->staff_id] as $key=>$val){
						$data['overtimes'][$worktime->staff_id][$key] = round($val /3600);
						$intOverTime +=($data['overtimes'][$worktime->staff_id][$key] >60)?1:0;
						$total += $val;
					}
					$data['overtimes'][$worktime->staff_id]['total']   = round($total/3600); 
					$data['overtimes'][$worktime->staff_id]['time']    = $intOverTime;
				}			
			}						
		}
		$pdf = PDF::loadView('backend.workingtime.pdf', $data);	

		return $pdf->download(ALL . '_' . rand('9999',time()).'.pdf');
	}

	public function get_work_time_array($id,$year)
	{
		$clsWorkingTime   = new WorkingTimeModel();
		$arrTempt = array();							
		$doorcard=  $clsWorkingTime->get_doorcard($id,$year);
		if(count($doorcard['timecards']) >0){
			$arrT         = explode(":",RESET_TIME);
		    $intStartTime = (isset($arrT[0]) &&  $arrT[0] >24)?$arrT[0]-24:0;
			foreach($doorcard['timecards'] as $val){
				$temptDate     = date("Y-m-d",strtotime($val->tt_date));
				$reset_time    = isset($intStartTime)?strtotime($temptDate.' '.$intStartTime.':00:00'):0;
				$start_time    = strtotime($temptDate.' '.START_TIME);
				$end_time      = strtotime($temptDate.' '.END_TIME);
				if(isset($arrTempt[$temptDate])){
					$arrTempt[$temptDate]['gotime'] = date("H:i:s",strtotime(compare_min($arrTempt[$temptDate]['gotime'],$val->tt_gotime)));
					$arrTempt[$temptDate]['backtime'] = date("H:i:s",strtotime(compare_max($val->tt_backtime,$arrTempt[$temptDate]['backtime'])));
				}else{
				    $arrTempt[$temptDate]['gotime'] = $val->tt_gotime;
					$arrTempt[$temptDate]['backtime'] = $val->tt_backtime;
				}	
				$gotime       = strtotime($temptDate.' '.$arrTempt[$temptDate]['gotime']);
				$backtime     = strtotime($temptDate.' '.$arrTempt[$temptDate]['backtime']);
				$overtime_out = ($end_time < $backtime)?$backtime - $end_time:0;		
                if($gotime < $reset_time){
                    $arrT          = explode("-",$temptDate)  ;
                    $arrTempt[date("Y-m-d",mktime(0, 0, 0, $arrT[1],$arrT[2] -1, $arrT[0]))]['overtime'] = $reset_time-$gotime;
                    $overtime_in   = $start_time - $reset_time ;
                }else{
                    $overtime_in   = ($gotime < $start_time)?$start_time-$gotime:0;
                }
                $arrTempt[$temptDate]['overtime'] = isset($arrTempt[$temptDate]['overtime'])?$arrTempt[$temptDate]['overtime'] + $overtime_in + $overtime_out:$overtime_in + $overtime_out;
			}
		}				
		
		if(count($doorcard['doorcards']) >0){
			foreach($doorcard['doorcards'] as $val){
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
		if(count($doorcard['pcs']) >0){
			foreach($doorcard['pcs'] as $val){
				$temptDate = date("Y-m-d",strtotime($val->tp_actiontime));
				if(isset($arrTempt[$temptDate])){
					if(!isset($arrTempt[$temptDate]['pc_in']))
					{
                        $arrTempt[$temptDate]['pc_in'] = date("H:i:s",strtotime($val->tp_actiontime));
                        $arrTempt[$temptDate]['pc_out'] = date("H:i:s",strtotime($val->tp_actiontime));
					}else{
						$temptDateIn     = strtotime($temptDate.' '.$arrTempt[$temptDate]['pc_in']);
						$temptDateOut    = strtotime($temptDate.' '.$arrTempt[$temptDate]['pc_out']);
					    $temptDateSource = strtotime($val->tp_actiontime);
					    if($temptDateSource < $temptDateIn)
					    	$arrTempt[$temptDate]['pc_in'] = date("H:i:s",strtotime($val->tp_actiontime));
					    if($temptDateSource > $temptDateOut)
					    	$arrTempt[$temptDate]['pc_out'] = date("H:i:s",strtotime($val->tp_actiontime));
					} 
				}else{
                    $arrTempt[$temptDate]['pc_in'] = date("H:i:s",strtotime($val->tp_actiontime));
                    $arrTempt[$temptDate]['pc_out'] = date("H:i:s",strtotime($val->tp_actiontime));
				}				
			}	
		}			
		if(count($arrTempt) >0){
			foreach($arrTempt as $key=>$val){			    				
				$time_in       = isset($val['gotime'])?get_time_diff(isset($val['touchtime_in'])?$val['touchtime_in']:0,isset($val['pc_in'])?$val['pc_in']:0,isset($val['gotime'])?$val['gotime']:0):0; 			
 				$time_out      = isset($val['backtime'])?get_time_diff(isset($val['touchtime_out'])?$val['touchtime_out']:0 ,isset($val['pc_out'])?$val['pc_out']:0,isset($val['backtime'])?$val['backtime']:0):0;	
 				$arrTempt[$key]['diff']   = floor(($time_in + $time_out)/60) ; 				 													
			}
		}
		return $arrTempt;
	}
	public function get_over_time_year($id,$year)
	{
		$clsWorkingTime   = new WorkingTimeModel();
		$arrTempt = array();$arrResult = array();						
		$workingTimes = $clsWorkingTime->get_timecard($id,$year);
		$arrT         = explode(":",RESET_TIME);
		$intStartTime = (isset($arrT[0]) &&  $arrT[0] >24)?$arrT[0]-24:0;

		if(count($workingTimes) >0){
			foreach($workingTimes as $workingTime){
				$temptDate = isset($workingTime->tt_date)?date("Y-m-d",strtotime($workingTime->tt_date)):date("Y-m-d");				
				if(isset($workingTime->tt_gotime))
				{
					$temptGotime 	= isset($workingTime->tt_gotime)?strtotime($temptDate.' '.$workingTime->tt_gotime):0;
					$temptBacktime 	= isset($workingTime->backtime)?strtotime($temptDate.' '.$workingTime->backtime):0;
					$temptResetTime = isset($intStartTime)?strtotime($temptDate.' '.$intStartTime.':00:00'):0;
					$temptStarttime = isset($workingTime->tt_gotime)?strtotime($temptDate.' '.START_TIME):0;
					$temptEndtime 	= isset($workingTime->tt_gotime)?strtotime($temptDate.' '.END_TIME):0;
					$overtime_out   = ($temptEndtime < $temptBacktime)?$temptBacktime - $temptEndtime:0;
                    if($temptGotime < $temptResetTime){
                    	$arrT          = explode("-",$temptDate)  ;
                        $arrTempt[date("Y-m-d",mktime(0, 0, 0, $arrT[1],$arrT[2] -1, $arrT[0]))] = $temptResetTime-$temptGotime;
                    	$overtime_in   = $temptResetTime -$temptStarttime;
                    }else{
                    	$overtime_in   = ($temptGotime < $temptStarttime)?$temptStarttime-$temptGotime:0;
                    }
                    $arrTempt[$temptDate] = isset($arrTempt[$temptDate])?$arrTempt[$temptDate] + $overtime_in + $overtime_out:$overtime_in + $overtime_out;
				}					
			}
			if(count($arrTempt) >0){
				foreach($arrTempt as $key=>$val){
					$month = date("n",strtotime($key));					
					$arrResult[$month] =isset($arrResult[$month])?$arrResult[$month] + $val:$val;
				}
			}
		}
		return 	$arrResult;		

	}
}