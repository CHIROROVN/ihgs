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
		$data['cb_year']      = (count($inputs) >0)?Input::get('cb_year', null):date('Y');
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
 					$temptDoor     = isset($val['touchtime_in'])?strtotime($key.' '.$val['touchtime_in']):'';
					$temptPC       = isset($val['pc_in'])?strtotime($key.' '.$val['pc_in']):'';
					$tempt         = isset($val['gotime'])?strtotime($key.' '.$val['gotime']):'';
					$time_in       = ($temptDoor  >$temptPC )?$temptDoor-$tempt:$temptPC-$tempt;					
 				}
 				if(isset($val['backtime'])){
 					$temptDoor     = isset($val['touchtime_out'])?strtotime($key.' '.$val['touchtime_out']):'';
					$temptPC       = isset($val['pc_out'])?strtotime($key.' '.$val['pc_out']):'';
					$tempt         = isset($val['backtime'])?strtotime($key.' '.$val['backtime']):'';
					$time_out      = ($temptDoor  >$temptPC )?$temptDoor-$tempt:$temptPC-$tempt;
 				} 				
 				$arrTempt[$key]['diff'] = ceil(($time_in + $time_out)/3600) ;
			}
		}	
		
		$data['worktimes']  = $arrTempt;
		/*echo '<pre>';
		print_r($data['worktimes']);
		echo '</pre>';/*die;*/
		return view('backend.workingtime.detail',$data);
	}
	public function exportPDF()
	{
		$clsWorkingTime   = new WorkingTimeModel();
		$data = array();

		$data['staff_belong'] = !empty(Input::get('staff_belong')) ? Input::get('staff_belong') : null;		

		if(!empty(Input::get('cb_year'))){
			$data['cb_year'] = Input::get('cb_year');
		}

		$data['overwork'] = $clsWorkingTime->get_timecard($data['staff_belong'], $data['cb_year']);

		$pdf = PDF::loadView('backend.workingtime.pdf', $data);

		return $pdf->download(ALL . '_' . rand('9999',time()).'.pdf');

		//return view('backend.workingtime.pdf',$data);
	}
}