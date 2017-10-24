<?php namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Backend\BackendController;
use App\Http\Models\WorkingTimeModel;
use App\Http\Models\BelongModel;
use Input;
use Validator;
use Session;
use PDF;
//use Config;

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

		//echo "<pre>";print_r($data['worktimes']);echo "</pre>";
		return view('backend.workingtime.index',$data);
	}

	public function detail($id){
		$clsWorkingTime   = new WorkingTimeModel();
        $data['year']     = (isset($_GET['year']) && $_GET['year'] >2000)?$_GET['year']:'2017';
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
		/*echo '<pre>';
		print_r($pdf);
		echo '</pre>';die;*/

		return $pdf->download(ALL . '_' . rand('9999',time()).'.pdf');

		//return view('backend.workingtime.pdf',$data);
	}

	public function get_work_time_array($id,$year)
	{
		$clsWorkingTime   = new WorkingTimeModel();
		$arrTempt = array();							
		$doorcard=  $clsWorkingTime->get_doorcard($id,$year);
		if(count($doorcard['timecards']) >0){
			foreach($doorcard['timecards'] as $val){
				$temptDate = date("Y-m-d",strtotime($val->tt_date));
				if(isset($arrTempt[$temptDate])){
					echo "<br>".strtotime($val->tt_gotime);
					echo "<br>".strtotime($val->tt_backtime);

				}else{
					$arrTempt[$temptDate]['gotime'] = $val->tt_gotime;
					$arrTempt[$temptDate]['backtime'] = $val->tt_backtime;
				}
				
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
		//
		if(count($arrTempt) >0){
			foreach($arrTempt as $key=>$val){
			    $temptDoor=0;$time_out=0;$time_in=0;$overtime_in=0;$overtime_out=0;				
				if(isset($val['gotime'])){									
 					$temptDoor     = isset($val['touchtime_in'])?strtotime($key.' '.$val['touchtime_in']):0;
					$temptPC       = isset($val['pc_in'])?strtotime($key.' '.$val['pc_in']):0;
					$tempt         = isset($val['gotime'])?strtotime($key.' '.$val['gotime']):0;
					$start_time    = strtotime($key.' '.START_TIME);					
					$time_in       = ($temptDoor  >$temptPC )?(int)$tempt-(int)$temptPC:(int)$temptDoor-(int)$tempt;
					$time_in       = ($time_in <0)?(-1)*$time_in:$time_in;
					$overtime_in   = (is_numeric($tempt) && $start_time > $tempt )?$start_time - $tempt :0 ;

 				}
 				if(isset($val['backtime'])){
 					$temptDoor     = isset($val['touchtime_out'])?strtotime($key.' '.$val['touchtime_out']):0;
					$temptPC       = isset($val['pc_out'])?strtotime($key.' '.$val['pc_out']):0;
					$tempt         = isset($val['backtime'])?strtotime($key.' '.$val['backtime']):0;
					$end_time      = strtotime($key.' '.END_TIME);
					$time_out      = ($temptDoor  >$temptPC )?(int)$temptDoor-(int)$tempt:(int)$temptPC-(int)$tempt;
					$time_out      = ($time_out <0)?(-1)*$time_out:$time_out;
					$overtime_out  = ($end_time < $tempt)?$tempt - $end_time :0 ;
 				} 				
 				$arrTempt[$key]['diff'] = ceil(($time_in + $time_out)/60) ;
 				$arrTempt[$key]['overtime'] = round(($overtime_in  + $overtime_out)/3600) ;	
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