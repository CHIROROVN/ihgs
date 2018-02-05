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
		$clsPC 			= new PcModel();
		$data['pc']     = $clsPC->getPC();
		$data['error']['error_td_dataname_required']    = trans('validation.error_tp_dataname_required');
        $data['error']['error_file_path_required']      = trans('validation.error_tp_file_csv_required');
        $data['error']['error_tp_file_csv_mimes']       = trans('validation.error_tp_file_csv_mimes');
        $data['error']['msg_import_setting_danger']     = trans('common.msg_import_setting_danger');
		$data['pcs']    = $clsPcImport->get_all_by_dataname();         
		return view('backend.pc.import', $data);
	}

	//post inport csv
	public function postimport(){
		//mpc format		
        	
        $inputs         = Input::all();	
		$clsPcImport    = new PcImportModel();		
		/*$Rules = $clsPcImport->Rules();
		$clsPC 			= new PcModel();

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
        } */      
                   		 
        $flag = true;
		if(Input::hasFile('tp_file_csv')){						
			$path = Input::file('tp_file_csv')->getRealPath();
			$file_csv   = array();
            $ary[] = "ASCII";$ary[] = "JIS";$ary[] = "EUC-JP";$ary[] = "Shift-JIS";$ary[] = "eucjp-win";$ary[] = "sjis-win";          
            $string = file_get_contents($path); 
            if(mb_detect_encoding($string) !=='UTF-8')
            {             	
                $str = mb_convert_encoding($string, "UTF-8", mb_detect_encoding($string, $ary));            
                $convert = explode("\n", $str);   
            }else $convert = explode("\n", $string);  
            for ($i=1;$i<count($convert);$i++)  
            {
                $arrTempt = explode(",",$convert[$i]);                
                if(isset($arrTempt[(int)$inputs['mp_pc_no_row']-1]) && !empty($arrTempt[(int)$inputs['mp_pc_no_row']-1]) && !empty($arrTempt[(int)$inputs['mp_staff_id_no_row']-1])){                    		 			                     				   
				   $data['tp_dataname']            = $inputs['tp_dataname'];
				   $data['tp_pc_no']			   = $arrTempt[(int)$inputs['mp_pc_no_row']-1];
				   $data['tp_staff_id_no']		   = $arrTempt[(int)$inputs['mp_staff_id_no_row']-1];
				   if((int)$inputs['mp_datetime_row'] >0){
                      $data['tp_date']		   		   = date('Y-m-d', strtotime($arrTempt[(int)$inputs['mp_datetime_row']-1])) ;
					   $data['tp_logintime']		   = date('H:i:s', strtotime($arrTempt[(int)$inputs['mp_datetime_row']-1])) ;
					   $data['tp_logouttime']		   = date('H:i:s', strtotime($arrTempt[(int)$inputs['mp_datetime_row']-1])) ;
				   }else{					   
					   $data['tp_date']		   		   = date('Y-m-d', strtotime($arrTempt[(int)$inputs['mp_date_row']-1])) ;
					   $data['tp_logintime']		   = date('H:i:s', strtotime($arrTempt[(int)$inputs['mp_logintime_row']-1])) ;
					   $data['tp_logouttime']		   = date('H:i:s', strtotime($arrTempt[(int)$inputs['mp_logouttime_row']-1])) ;
					}   
				   $data['last_ipadrs']            = CLIENT_IP_ADRS;
				   $data['last_date']              = date('Y-m-d H:i:s');
				   $data['last_user']              = Auth::user()->u_id;						  				   				   				   				   					 					
                  if(!empty($data['tp_pc_no']))     $clsPcImport->insert($data);
				}   
            }    
            /*$file_csv  = $this->readFileCsv($path);                

			if(!empty($file_csv) && count($file_csv)){ 				
				foreach ($file_csv as  $value) {				    
				   if(isset($value[$config->mp_date_row]) && (!empty($value[$config->mp_logintime_row]) || !empty($value[$config->mp_logouttime_row]))){				 			                     				   
					   $data['tp_dataname']            = Input::get('tp_dataname');
					   $data['tp_pc_no']			   = isset($value[$config->mp_pc_no_row])?$value[$config->mp_pc_no_row]:'';
					   $data['tp_staff_id_no']		   = isset($value[$config->mp_staff_id_no_row])?$value[$config->mp_staff_id_no_row]:'';					   
					   $data['tp_date']		   		   = date('Y-m-d', strtotime($value[$config->mp_date_row])) ;
					   $data['tp_logintime']		   = date('H:i:s', strtotime($value[$config->mp_logintime_row])) ;;
					   $data['tp_logouttime']		   = date('H:i:s', strtotime($value[$config->mp_logouttime_row])) ;;
					   $data['last_ipadrs']            = CLIENT_IP_ADRS;
					   $data['last_date']              = date('Y-m-d H:i:s');
					   $data['last_user']              = Auth::user()->u_id;						  				   				   				   				   					 
                       if(!empty($data['tp_pc_no']))     $clsPcImport->insert($data);
					}   
                }//end foreach value   	
			}*/
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