<?php namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Backend\BackendController;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Models\DoorcardModel;
use Auth;
use Hash;
use Form;
use Html;
use Input;
use Validator;
use URL;
use Session;
use Config;
use Excel;

class DoorController extends BackendController
{
	public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
    }

	public function index(){
		return view('backend.door.index');
	}

	public function getRegist(){
		$data =array();
		$data['date_formats'] = Config::get('constants.MD_TOUCHTIME_FORMAT');

		$data['error']['error_door_format_required']    = trans('validation.error_door_format_required');
		return view('backend.door.regist',$data);
	}

	public function postRegist()
    {
        $clsDoorcard      = new DoorcardModel();
        $inputs         = Input::all();
        $validator      = Validator::make($inputs, $clsDoorcard->Rules(), $clsDoorcard->Messages());
        if ($validator->fails()) {
            return redirect()->route('backend.door.regist')->withErrors($validator)->withInput();
        }
        // insert       
        $dataInsert                 = array(
            'md_card_no_row'       => Input::get('md_card_no_row'),                        
            'md_door_row'           => Input::get('md_door_row'), 
            'md_door_format'        => Input::get('md_door_format'),
            'md_touchtime_row'      => Input::get('md_touchtime_row'),
            'md_touchtime_format'   => Input::get('md_touchtime_format'),            
            'last_date'             => date('Y-m-d H:i:s'),
            'last_kind'             => INSERT,
            'last_ipadrs'           => CLIENT_IP_ADRS,
            'last_user'             => Auth::user()->u_id            
        );        
        if ( $clsDoorcard->insert($dataInsert)  ) {
            Session::flash('success', trans('common.msg_regist_success'));
        } else {
            Session::flash('danger', trans('common.msg_regist_danger'));
        }        
        
        return redirect()->route('backend.door.regist');
    }
}