<?php namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Backend\BackendController;
use App\Http\Models\PcImportModel;

use Input;
use Validator;
use Session;
use Excel;
//use Config;

class PcController extends BackendController
{
	//get import csv
	public function import(){
		$clsPc            = new PcImportModel();
		
		return view('backend.pc.import');
	}

	//post inport csv
	public function postimport(){

		echo '<pre>';
		print_r(Input::all());
		echo '</pre>';die;

	}
}