<?php namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Backend\BackendController;

use Input;
use Validator;
use Session;
use Config;

class SearchController extends BackendController
{
	public function index(){
		return view('backend.search.index');
	}
}