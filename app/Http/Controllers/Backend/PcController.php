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
use File;

class PcController extends BackendController
{
	//get import csv
	public function import(){
		$clsPcImport    = new PcImportModel();

		$pcs = $clsPcImport->getPc();

		return view('backend.pc.import', compact('pcs'));
	}

	//post inport csv
	public function postimport(){
		//mpc format
		$clsPC 			= new PcModel();
		$mp_format = $clsPC->getPC();

		$clsPcImport    = new PcImportModel();
		$Rules = $clsPcImport->Rules();

		if(Input::hasFile('tp_file_csv')){
			$file = Input::file('tp_file_csv');
			$extension = $file->getClientOriginalExtension();

			if($extension == 'csv' || $extension == 'CSV' || $extension == 'xls' || $extension == 'xlsx'){
				unset($Rules['tp_file_csv']);
			}
		}

		$validator = Validator::make(Input::all(), $Rules, $clsPcImport->Messages());

		if ($validator->fails()) {
			return redirect()->route('backend.pc.import')->withErrors($validator)->withInput();
		}

		if(Input::hasFile('tp_file_csv')){
			
			$file_upload = Input::file('tp_file_csv');


			$path = Input::file('tp_file_csv')->getRealPath();

			$file_csv = Excel::load($path, function($reader) {
				//$reader->limitRows(10);
				//$reader->getTitle();
			}, 'UTF-8')->get();

				// echo '<pre>';
				// print_r($file_csv->getHeading());
				// echo '</pre>';die;

			if(!empty($file_csv) && $file_csv->count()){
				//$file_csv = $file_csv->toArray();
				$flag = false;
				foreach ($file_csv as $valPc) {
					$dataPc[] = ['tp_pc_no' => $valPc->tp_pc_no, 'tp_action' => $valPc->tp_action, 'tp_actiontime' => $valPc->tp_actiontime];

				}
			}

		}

		$flag = false;
		if(!empty($dataPc)){
			foreach ($dataPc as $valPc) {

				$data['tp_dataname']            = Input::get('tp_dataname');
				$data['tp_pc_no']				= $valPc['tp_pc_no'];
				$data['tp_action']				= $valPc['tp_action'];

				$data['tp_actiontime']			= date('Y-m-d', strtotime($valPc['tp_actiontime']));

				$data['last_ipadrs']            = CLIENT_IP_ADRS;
				$data['last_date']              = date('Y-m-d H:i:s');
				$data['last_user']              = Auth::user()->u_id;

				if($clsPcImport->insert($data)){
					$flag = true;

					//Upload file to host
					$extension = $file_upload->getClientOriginalExtension();
					$file_name = $file_upload->getClientOriginalName();
					$fn_arr = explode('.', $file_name);
					$fn_original = $fn_arr[0];

					$fn_new = $fn_original.'_'.rand(time(),time()).'.'.$extension;
					$path_upload        = '/uploads/pc/';
					move_uploaded_file($file_upload, public_path() . $path_upload . $fn_new);

				}else{
					$flag = false;
				}
			}
		}

		if($flag){
			Session::flash('success', trans('common.msg_import_success'));
			return redirect()->route('backend.pc.import');
		}else{
			Session::flash('danger', trans('common.msg_import_danger'));
			return redirect()->route('backend.pc.import');
		}
	}

	/*
	|-----------------------------------
	|  delete item csv
	|-----------------------------------
	*/
	public function delete($tp_dataname){
		$clsPcImport    = new PcImportModel();
        if ( $clsPcImport->delete($tp_dataname) ) {
        	Session::flash('success', trans('common.msg_delete_success'));
            return redirect()->route('backend.pc.import');
        } else {
        	Session::flash('success', trans('common.msg_delete_danger'));
            return redirect()->route('backend.pc.import');
        }
	}

	

}