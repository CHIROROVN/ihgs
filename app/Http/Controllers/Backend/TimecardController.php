<?php namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Backend\BackendController;
use App\Http\Requests;
use Illuminate\Http\Request;
use Auth;
use Hash;
use App\User;
use App\Http\Models\TimecardModel;
use App\Http\Models\TimecardImportModel;
use Form;
use Html;
use Input;
use Validator;
use URL;
use Session;
use Config;

class TimecardController extends BackendController
{
	
	public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
    }
	
	public function index(){
        $data =array();
        $clsTimecard          = new TimecardImportModel();
        $data['timecards']    = $clsTimecard->get_all();
		return view('backend.timecard.index',$data);
	}

    public function import()
    {
        $dataInput              = array();
        $clsForum               = new TimecardImportModel();
        $inputs                 = Input::all();
        $rules                  = $clsForum->Rules();
        if(!Input::hasFile('forum_file_path')){
            unset($rules['forum_file_path']);
            unset($rules['forum_file_name']);
        }
    }

	public function getRegist(){
        $data['date_formats'] = Config::get('constants.MT_DATE_FORMAT');
        $data['time_formats'] = Config::get('constants.MT_TIME_FORMAT');        
		return view('backend.timecard.regist',$data);
	}

	public function postRegist()
    {
        $clsTimecard      = new TimecardModel();
        $inputs         = Input::all();
        $validator      = Validator::make($inputs, $clsTimecard->Rules(), $clsTimecard->Messages());
        if ($validator->fails()) {
            return redirect()->route('backend.timecard.regist')->withErrors($validator)->withInput();
        }
        // insert       
        $dataInsert                 = array(
            'mt_staff_id_row'       => Input::get('mt_staff_id_row'),                        
            'mt_date_row'           => Input::get('mt_date_row'), 
            'mt_date_format'        => Input::get('mt_date_format'),
            'mt_gotime_row'         => Input::get('mt_gotime_row'),
            'mt_gotime_format'      => Input::get('mt_gotime_format'),
            'mt_backtime_row'       => Input::get('mt_backtime_row'),
            'mt_backtime_format'    => Input::get('mt_backtime_format'),
            'last_date'             => date('Y-m-d H:i:s'),
            'last_kind'             => INSERT,
            'last_ipadrs'           => CLIENT_IP_ADRS,
            'last_user'             => Auth::user()->u_id            
        );
        
        if ( $clsBelong->insert($dataInsert) ) {
            Session::flash('success', trans('common.msg_regist_success'));
        } else {
            Session::flash('danger', trans('common.msg_regist_danger'));
        }
        return redirect()->route('backend.division.index');
    }
}