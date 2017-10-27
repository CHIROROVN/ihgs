<?php namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Backend\BackendController;
use App\Http\Models\PcModel;

use Input;
use Validator;
use Session;
use Auth;
use Config;

class PcFormatController extends BackendController
{
	public function format(){
		$clsPc            = new PcModel();
		$mpc = $clsPc->getPc();
		$pc_date_format = Config::get('constants.PC_DATETIME_FORMAT');
		$date_formats = Config::get('constants.MT_DATE_FORMAT');
        $time_formats = Config::get('constants.MT_TIME_FORMAT'); 	
		return view('backend.pc.format', compact('mpc', 'pc_date_format','date_formats','time_formats'));
	}


	public function postFormat(){
		$clsPc            = new PcModel();

		if(!empty(Input::get('mp_id'))){
			//Update
			$data['mp_pc_no_row'] 			= Input::get('mp_pc_no_row');
			$data['mp_action_row'] 			= Input::get('mp_action_row');
			$data['mp_action_format1'] 		= Input::get('mp_action_format1');
			$data['mp_action_format2'] 		= Input::get('mp_action_format2');
			$data['mp_actiontime_row'] 		= Input::get('mp_actiontime_row');
			$data['mp_actiontime_format'] 	= Input::get('mp_actiontime_format');

			$data['last_ipadrs']            = CLIENT_IP_ADRS;
			$data['last_date']              = date('Y-m-d H:i:s');
			$data['last_user']              = Auth::user()->u_id;
			$data['last_kind']              = UPDATE;

			if ( $clsPc->update(Input::get('mp_id'), $data) ) {
				Session::flash('success', trans('common.msg_edit_success'));
				return redirect()->route('backend.pc.format');
			} else {
				Session::flash('danger', trans('common.msg_edit_danger'));
				return redirect()->route('backend.pc.format');
			}

		}else{
			//Insert
			$data['mp_pc_no_row'] 			= Input::get('mp_pc_no_row');
			$data['mp_action_row'] 			= Input::get('mp_action_row');
			$data['mp_action_format1'] 		= Input::get('mp_action_format1');
			$data['mp_action_format2'] 		= Input::get('mp_action_format2');
			$data['mp_actiontime_row'] 		= Input::get('mp_actiontime_row');
			$data['mp_actiontime_format'] 	= Input::get('mp_actiontime_format');

			$data['last_ipadrs']            = CLIENT_IP_ADRS;
			$data['last_date']              = date('Y-m-d H:i:s');
			$data['last_user']              = Auth::user()->u_id;
			$data['last_kind']              = INSERT;

			if ( $clsPc->insert($data) ) {
				Session::flash('success', trans('common.msg_edit_success'));
				return redirect()->route('backend.pc.format');
			} else {
				Session::flash('danger', trans('common.msg_edit_danger'));
				return redirect()->route('backend.pc.format');
			}
		}
		

	}
}