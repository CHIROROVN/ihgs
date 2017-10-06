<?php namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Backend\BackendController;

use Input;
use Validator;
use Session;
use Config;

class TimecardController extends BackendController
{
	public function index(){
		return view('backend.timecard.index');
	}
	public function edit(){
		return view('backend.timecard.edit');
	}
}