<?php namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Backend\BackendController;
use App\Http\Models\PcModel;

use Input;
use Validator;
use Session;
use Auth;
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
				return redirect()->route('backend.pc_format.index');
			} else {
				Session::flash('danger', trans('common.msg_edit_danger'));
				return redirect()->route('backend.pc_format.index');
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
				return redirect()->route('backend.pc_format.index');
			} else {
				Session::flash('danger', trans('common.msg_edit_danger'));
				return redirect()->route('backend.pc_format.index');
			}
		}
		

	}
}