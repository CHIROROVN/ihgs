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
		$clsWorkingTime            = new WorkingTimeModel();
		$clsBelong            = new BelongModel();
		$data['divisions']    = $clsBelong->list_division_tree(); 		
		return view('backend.workingtime.index',$data);
	}

	public function detail(){
		$clsWorkingTime            = new WorkingTimeModel();
		
		return view('backend.workingtime.detail');
	}
}