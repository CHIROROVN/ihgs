<?php namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Backend\BackendController;
use App\Http\Models\PcImportModel;
use App\Http\Models\PcModel;

use Input;
use Validator;
use Session;
use Excel;
use Auth;
use Config;

class PcController extends BackendController
{
	//get import csv
	public function import(){
		$clsPcImport    = new PcImportModel();
		// $clsPC 			= new PcModel();
		// $mp_format = $clsPC->getPC();
		return view('backend.pc.import');
	}

	//post inport csv
	public function postimport(){
		$clsPC 			= new PcModel();
		$mp_format = $clsPC->getPC();

			echo '<pre>';
			print_r($mp_format);
			echo '</pre>';die;

		$clsPcImport    = new PcImportModel();
		$Rules = $clsPcImport->Rules();

		if(Input::hasFile('tp_file_csv')){
			$file = Input::file('tp_file_csv');
			$extension = $file->getClientOriginalExtension();

			if($extension == 'csv' || $extension == 'CSV'){
				unset($Rules['tp_file_csv']);
			}
		}

		$validator = Validator::make(Input::all(), $Rules, $clsPcImport->Messages());

		if ($validator->fails()) {
			return redirect()->route('backend.pc.import')->withErrors($validator)->withInput();
		}

		if(Input::hasFile('tp_file_csv')){

			$path = Input::file('tp_file_csv')->getRealPath();
			$file_csv = Excel::load($path, function($reader) {
			})->get();

			if(!empty($file_csv) && $file_csv->count()){
				foreach ($file_csv as $key => $value) {
					$data_csv[] = ['title' => $value->title, 'description' => $value->description];
				}

				if(!empty($data_csv)){
						echo '<pre>';
						print_r($data_csv);
						echo '</pre>';
				}


			}

		}

		$data['tp_dataname']            = Input::get('tp_dataname');

		$data['last_ipadrs']            = CLIENT_IP_ADRS;
		$data['last_date']              = date('Y-m-d H:i:s');
		$data['last_user']              = Auth::user()->u_id;
		$data['last_kind']              = INSERT;

			echo '<pre>';
			print_r($data);
			echo '</pre>';die;



	}
}