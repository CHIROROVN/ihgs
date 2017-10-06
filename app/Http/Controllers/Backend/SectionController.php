<?php namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Backend\BackendController;

use Input;
use Validator;
use Session;
use Config;

class SectionController extends BackendController
{
	public function index(){
		return view('backend.section.index');
	}
	public function regist(){
		return view('backend.section.regist');
	}
}