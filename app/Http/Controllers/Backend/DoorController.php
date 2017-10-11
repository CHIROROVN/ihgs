<?php namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Backend\BackendController;

use Input;
use Validator;
use Session;
use Config;

class DoorController extends BackendController
{
	public function index(){
		return view('backend.door.index');
	}
	public function getRegist(){
		return view('backend.door.regist');
	}
}