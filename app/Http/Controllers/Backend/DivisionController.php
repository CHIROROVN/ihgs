<?php namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Backend\BackendController;

use Input;
use Validator;
use Session;
use Config;

class DivisionController extends BackendController
{
	public function index(){
		return view('backend.division.index');
	}
}