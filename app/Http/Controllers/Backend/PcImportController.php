<?php namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Backend\BackendController;
use App\Http\Models\PcImportModel;

use Input;
use Validator;
use Session;
//use Config;

class PcImportController extends BackendController
{
	public function index(){
		$clsPc            = new PcImportModel();
		
		return view('backend.pc_import.index');
	}
}