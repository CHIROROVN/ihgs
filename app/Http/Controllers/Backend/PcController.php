<?php namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Backend\BackendController;
use App\Http\Models\PcImportModel;
use App\Http\Models\PcModel;
use Input;
use Validator;
use Session;
use Auth;
use Config;
use File;

class PcController extends BackendController
{
	//get import csv
	public function import(){
		$clsPcImport    = new PcImportModel();		
		$pcs= $clsPcImport->get_all_by_dataname();         
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
		$config = $clsPC->getPc();		
		if(!isset($config->mp_id)){
            Session::flash('danger', trans('common.msg_import_setting_danger'));
            return redirect()->route('backend.pc.import');
        }       
                   		 
        $flag = true;
		if(Input::hasFile('tp_file_csv')){			
			$file_upload = Input::file('tp_file_csv');
			$path = Input::file('tp_file_csv')->getRealPath();
			$file_csv   = array();
            $file_csv  = $this->readFileCsv($path);   
             

			if(!empty($file_csv) && count($file_csv)){ 				
				foreach ($file_csv as  $value) {				    
				   if(isset($value[$config->mp_date_row]) && !empty($value[$config->mp_date_row])){				 			                     				   
					   $data['tp_dataname']            = Input::get('tp_dataname');
					   $data['tp_pc_no']			   = isset($value[$config->mp_pc_no_row])?$value[$config->mp_pc_no_row]:'';
					   $data['tp_staff_id_no']		   = isset($value[$config->mp_staff_id_no_row])?$value[$config->mp_staff_id_no_row]:'';					   
					   $data['tp_date']		   		   = date('Y-m-d', strtotime($value[$config->mp_date_row])) ;
					   $data['tp_logintime']		   = date('H:i:s', strtotime($value[$config->mp_logintime_row])) ;;
					   $data['tp_logouttime']		   = date('H:i:s', strtotime($value[$config->mp_logouttime_row])) ;;
					   $data['last_ipadrs']            = CLIENT_IP_ADRS;
					   $data['last_date']              = date('Y-m-d H:i:s');
					   $data['last_user']              = Auth::user()->u_id;						   				   				   				   
					   $clsPcImport->insert($data);
					}   
                }//end foreach value   	
			}
		}else $flag = false;
        
		if($flag)	Session::flash('success', trans('common.msg_import_success'));			
		else		Session::flash('danger', trans('common.msg_import_danger'));			
		
		//return redirect()->route('backend.pc.import');
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