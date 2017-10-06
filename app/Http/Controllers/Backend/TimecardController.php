<?php namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Backend\BackendController;

use Input;
use Validator;
use Session;
use Config;

class TimecardController extends BackendController
{
	/*
	public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
    }
	*/
	public function index(){
		return view('backend.timecard.index');
	}
	public function getRegist(){
		return view('backend.timecard.regist');
	}
}