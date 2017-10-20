<?php namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Backend\BackendController;
use App\Http\Models\WorkingTimeModel;
use App\Http\Models\BelongModel;
use Input;
use Validator;
use Session;
//use Config;

class WorkingTimeController extends BackendController
{
	public function index(){
		$data                 = array();
        $inputs               = Input::all();                
		$clsWorkingTime       = new WorkingTimeModel();
		$clsBelong            = new BelongModel();
		$data['staff_belong'] = (count($inputs) >0)?Input::get('staff_belong', null):'';		
		$data['cb_year']      = (count($inputs) >0)?Input::get('cb_year', null):'2017';
		//$data['divisions']    = $clsBelong->list_division_tree(); 
		
		$data['worktimes']    = (count($inputs) >0)?$clsWorkingTime->get_all($data['staff_belong'],$data['cb_year'] ):array(); 
		//echo "<pre>";print_r($data['worktimes']);echo "</pre>";
		return view('backend.workingtime.index',$data);
	}

	public function detail($id){
		$clsWorkingTime   = new WorkingTimeModel();
        $data['year']     = (isset($_GET['year']) && $_GET['year'] >2000)?$_GET['year']:'2017';
		$data['staff']    =  $clsWorkingTime->get_by_id($id);
		$strCard = (isset($data['staff']->staff_card1) && !empty($data['staff']->staff_card1))?"'".$data['staff']->staff_card1."'":'';
		$strCard .= (isset($data['staff']->staff_card2) && !empty($data['staff']->staff_card2))?((!empty($strCard))?",'".$data['staff']->staff_card2."'":"'".$data['staff']->staff_card2."'"):'';	
		$strCard .= (isset($data['staff']->staff_card3) && !empty($data['staff']->staff_card3))?((!empty($strCard))?",'".$data['staff']->staff_card3."'":"'".$data['staff']->staff_card3."'"):'';	
		$strCard .= (isset($data['staff']->staff_card4) && !empty($data['staff']->staff_card4))?((!empty($strCard))?",'".$data['staff']->staff_card4."'":"'".$data['staff']->staff_card4."'"):'';	
		$strCard .= (isset($data['staff']->staff_card5) && !empty($data['staff']->staff_card5))?((!empty($strCard))?",'".$data['staff']->staff_card5."'":"'".$data['staff']->staff_card5."'"):'';
		$arrTempt = array();		
		$worktimes=  $clsWorkingTime->get_timecard($id,$data['year']);
		if(count($worktimes) >0){
			foreach($worktimes as $val){
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
		$doorcard=  $clsWorkingTime->get_doorcard($id,$data['year']);
		
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
				if(isset($val['gotime'])){					
 					$temptDoor     = strtotime($val['touchtime_in']);
					$temptPC       = strtotime($val['pc_in']);
					$tempt         = strtotime($val['gotime']);
					$time_in       = ($temptDoor  >$temptPC )?$temptDoor-$tempt:$temptPC-$tempt;					
 				}
 				if(isset($val['backtime'])){
 					$temptDoor     = strtotime($key.' '.$val['touchtime_out']);
					$temptPC       = strtotime($key.' '.$val['pc_out']);
					$tempt         = strtotime($key.' '.$val['backtime']);
					$time_out      = ($temptDoor  >$temptPC )?$temptDoor-$tempt:$temptPC-$tempt;
 				}
 				//$time_total = $time_in + $time_out ;
 				//$arrTempt[$key]['diff'] = $time_total;
			}
		}	
		die;
		$data['worktimes']  = $arrTempt;
		/*echo '<pre>';
		print_r($data['worktimes']);
		echo '</pre>';die;*/
		return view('backend.workingtime.detail',$data);
	}
	public function exportPDF()
	{
	   $clsWorkingTime   = new WorkingTimeModel();	
	   $data = $clsWorkingTime->get_timecard($id,$data['year']);
	   /*return Excel::create('itsolutionstuff_example', function($excel) use ($data) {
		$excel->sheet('mySheet', function($sheet) use ($data)
	    {
			$sheet->fromArray($data);
	    });
	   })->download("pdf");*/
	}
}