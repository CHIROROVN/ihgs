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
		if(count($data['worktimes']) >0)
			foreach($data['worktimes']['data'] as $worktime)
				$data['overtimes'][$worktime->staff_id] =  $this->get_over_time_year($worktime->staff_id,$data['cb_year']);		
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
	   $clsWorkingTime   		= new WorkingTimeModel();
	   $clsBelong            	= new BelongModel();
	   $data = array();
		$data['staff_belong'] 	= !empty(Input::get('staff_belong')) ? Input::get('staff_belong') : null;
		$data['cb_year'] 		= !empty(Input::get('cb_year')) ? Input::get('cb_year') : null ;
		$data['worktimes']    	= $clsWorkingTime->get_all( $data['staff_belong'], $data['cb_year'] );
		$arrWorkTime = array(); 
		if(count($data['worktimes']) >0){
			foreach($data['worktimes']['data'] as $worktime){				
				$data['overtimes'][$worktime->staff_id]  =  $this->get_over_time_year($worktime->staff_id,$data['cb_year']);					
			}						
		}
		//return view('backend.workingtime.pdf',$data); 
		$pdf = PDF::loadView('backend.workingtime.pdf', $data,array(),[
										'mode'                 => 'utf-8',
										'format'               => 'A4-L',
										'default_font_size'    => '8',
										'default_font'         => 'Yu Gothic',
										'margin_left'          => 10,
										'margin_right'         => 10,
										'margin_top'           => 10,
										'margin_bottom'        => 10,
										'margin_header'        => 0,
										'margin_footer'        => 0,
										'orientation'          => 'P',
										'title'                => 'IHGS',
										'author'               => '',
										'display_mode'         => 'fullpage'
									]);	
		
		$fileName = !empty(division($data['staff_belong'])) ? division($data['staff_belong']) : ALL;
		return $pdf->download(mb_convert_encoding($fileName, 'UTF-8') . '_' . rand('9999',time()).'.pdf');
	}

	public function get_work_time_array($id,$year)
	{
		$clsWorkingTime   = new WorkingTimeModel();
		$arrTempt = array();$arrResult = array();							
		$doorcard=  $clsWorkingTime->get_doorcard($id,$year);
		if(count($doorcard['timecards']) >0){			
			foreach($doorcard['timecards'] as $val){
				$temptDate     = date("Y-m-d",strtotime($val->tt_date));												
				$arrTempt[$temptDate]['gotime']   = (!isset($arrTempt[$temptDate]['gotime']))?date("H:i:s",strtotime($val->tt_gotime)):date("H:i:s",strtotime(compare_min($arrTempt[$temptDate]['gotime'],$val->tt_gotime)));
				$arrTempt[$temptDate]['backtime'] =	(!isset($arrTempt[$temptDate]['backtime']))?date("H:i:s",strtotime($val->tt_backtime)):date("H:i:s",strtotime(compare_max($val->tt_backtime,$arrTempt[$temptDate]['backtime']))); 							               
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
				$temptDate = date("Y-m-d",strtotime($val->tp_date));				
				$arrTempt[$temptDate]['pc_in'] 	= (!isset($arrTempt[$temptDate]['pc_in']))?date("H:i:s",strtotime($val->tp_logintime)):date("H:i:s",strtotime(compare_min($val->tp_logintime, $arrTempt[$temptDate]['pc_in'])));
				$arrTempt[$temptDate]['pc_out'] = (!isset($arrTempt[$temptDate]['pc_out']))?date("H:i:s",strtotime($val->tp_logouttime)): date("H:i:s",strtotime(compare_max($arrTempt[$temptDate]['pc_out'], $val->tp_logouttime)));			
			}	
		}				
		if(count($arrTempt) >0){			
			foreach($arrTempt as $key=>$val){
				$time_in       = isset($val['gotime'])?get_time_diff(isset($val['touchtime_in'])?$val['touchtime_in']:0,isset($val['pc_in'])?$val['pc_in']:0,isset($val['gotime'])?$val['gotime']:0,'in'):0; 			
 				$time_out      = isset($val['backtime'])?get_time_diff(isset($val['touchtime_out'])?$val['touchtime_out']:0 ,isset($val['pc_out'])?$val['pc_out']:0,isset($val['backtime'])?$val['backtime']:0,'out'):0;	
 				$arrTempt[$key]['diff']   = floor(($time_in + $time_out)/60) ; 				 													
			}   
			

		}
		for($i=$year;$i<=$year+1;$i++){
			$startMonth = ($i==$year)?4:1;
			$endMonth   = ($i==$year)?12:3;
			for($j=$startMonth;$j<=$endMonth;$j++){
				$endDate = date("t",mktime(0,0,0,$j,1,$i));                 
                for($k=1;$k<=$endDate;$k++){
                	$strDate = date("Y-m-d",mktime(0,0,0,$j,$k,$i));
                	$arrResult[$strDate] = (array_key_exists($strDate,$arrTempt))?$arrTempt[$strDate]:array();
                }
			}
		}
		return $arrResult;
	}
	public function get_over_time_year($id,$year)
	{
		$clsWorkingTime   = new WorkingTimeModel();
		$arrTempt = array();$arrResult = array();						
		$workingTimes = $clsWorkingTime->get_timecard($id,$year);		

		if(count($workingTimes) >0){
			foreach($workingTimes as $val){
				$temptDate     = date("Y-m-d",strtotime($val->tt_date));													
				$arrTempt[$temptDate]['gotime']   = (!isset($arrTempt[$temptDate]['gotime']))?date("H:i:s",strtotime($val->tt_gotime)):date("H:i:s",strtotime(compare_min($arrTempt[$temptDate]['gotime'],$val->tt_gotime)));
				$arrTempt[$temptDate]['backtime'] =	(!isset($arrTempt[$temptDate]['backtime']))?date("H:i:s",strtotime($val->tt_backtime)):date("H:i:s",strtotime(compare_max($val->tt_backtime,$arrTempt[$temptDate]['backtime']))); 									               
			}	
			foreach($workingTimes as $workingTime){
				$temptDate = isset($workingTime->tt_date)?date("Y-m-d",strtotime($workingTime->tt_date)):date("Y-m-d");	
				$overtime_out =0;$overtime_in =0;			
				if(isset($workingTime->tt_gotime))
				{
					$temptGotime 	= isset($workingTime->tt_gotime)?strtotime($temptDate.' '.$workingTime->tt_gotime):0;									
					$temptStarttime = strtotime($temptDate.' '.START_TIME);					
					$overtime_in    = ($temptGotime > $temptStarttime)?0:$temptStarttime-$temptGotime ;

				}
				if(isset($workingTime->backtime))
				{
					$temptBacktime 	= isset($workingTime->backtime)?strtotime($temptDate.' '.$workingTime->backtime):0;		
					$temptEndtime 	= strtotime($temptDate.' '.END_TIME);
					$overtime_out    = ($temptBacktime < $temptEndtime)?0:$temptBacktime-$temptEndtime ;					
				}				
				$arrTempt[$temptDate] =$overtime_in +$overtime_out ;
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