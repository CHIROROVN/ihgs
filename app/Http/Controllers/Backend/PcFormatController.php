<?php namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Backend\BackendController;
use App\Http\Models\PcModel;

use Input;
use Validator;
use Session;
//use Config;

class PcFormatController extends BackendController
{
	public function index(){
		$clsPc            = new PcModel();
		$mpc = $clsPc->getPc();		
		return view('backend.pc_format.index', compact('mpc'));
	}


	public function postIndex(){
		$clsPc            = new PcModel();

			echo '<pre>';
			print_r(Input::all());
			echo '</pre>';die;

	}
}