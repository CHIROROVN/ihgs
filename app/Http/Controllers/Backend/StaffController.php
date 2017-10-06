<?php namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Backend\BackendController;

use Input;
use Validator;
use Session;
use Config;

class StaffController extends BackendController
{
	public function index(){
		return view('backend.staff.index');
	}
	public function regist(){
		return view('backend.staff.regist');
	}
	public function import(){
		return view('backend.staff.import');
	}
	public function search(){
		return view('backend.staff.search');
	}
}