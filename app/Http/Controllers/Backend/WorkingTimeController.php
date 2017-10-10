<?php namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Backend\BackendController;
use App\Http\Models\WorkingTimeModel;

use Input;
use Validator;
use Session;
//use Config;

class WorkingTimeController extends BackendController
{
	public function index(){
		$clsWorkingTime            = new WorkingTimeModel();
		
		return view('backend.workingtime.index');
	}

	public function detail(){
		$clsWorkingTime            = new WorkingTimeModel();
		
		return view('backend.workingtime.detail');
	}
}