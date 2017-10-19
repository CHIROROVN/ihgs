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
		$data['divisions']    = $clsBelong->list_division_tree(); 
		//$data['error']['error_belong_name_required']    = trans('validation.error_belong_name_required');
        //$data['error']['error_belong_code_required']    = trans('validation.error_belong_code_required');
		$data['worktimes']    = (count($inputs) >0)?$clsWorkingTime->get_all($data['staff_belong'],$data['cb_year'] ):array(); 
		//print_r($data['worktimes']);
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
		$data['worktimes']=  $clsWorkingTime->get_timecard($id,$data['year']);
		print_r($data['staff']);
		$data['doorcard']=  $clsWorkingTime->get_doorcard($strCard,$data['year']);
		
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