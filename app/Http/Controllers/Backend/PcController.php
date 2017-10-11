<?php namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Backend\BackendController;
use App\Http\Models\PcImportModel;
use App\Http\Models\PcModel;

use Input;
use Validator;
use Session;
use Excel;
//use Config;

class PcController extends BackendController
{
	//get import csv
	public function import(){
		$clsPcImport    = new PcImportModel();
		$clsPC 			= new PcModel();
		$mp_format = $clsPC->getPC();
		return view('backend.pc.import');
	}

	//post inport csv
	public function postimport(){
		$clsPcImport    = new PcImportModel();
		$validator = Validator::make(Input::all(), $clsPcImport->Rules(), $clsPcImport->Messages());

		if ($validator->fails()) {
			return redirect()->route('backend.pc.import')->withErrors($validator)->withInput();
		}

		$data['tp_dataname']            = Input::get('tp_dataname');

		$data['last_ipadrs']            = CLIENT_IP_ADRS;
		$data['last_date']              = date('Y-m-d H:i:s');
		$data['last_user']              = Auth::user()->u_id;
		$data['last_kind']              = INSERT;



	}
}