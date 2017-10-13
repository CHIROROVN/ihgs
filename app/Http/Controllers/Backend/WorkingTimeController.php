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
		$data['cb_year']      = (count($inputs) >0)?Input::get('cb_year', null):'';
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
		$data['staff']    =  $clsWorkingTime->get_by_id($id,$data['year']);
		//print_r($data['staff']);
		return view('backend.workingtime.detail',$data);
	}
}