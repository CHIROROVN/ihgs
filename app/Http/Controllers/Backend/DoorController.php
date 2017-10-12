<?php namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Backend\BackendController;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Models\DoorcardModel;
use App\Http\Models\DoorcardImportModel;
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
		$data =array();
        $clsDoorcard               = new DoorcardImportModel();
        $data['doorcards']         = $clsDoorcard->get_all();
        $data['error']['error_td_dataname_required']    = trans('validation.error_td_dataname_required');
        $data['error']['error_file_path_required']      = trans('validation.error_file_path_required');
		return view('backend.door.index',$data);
	}

	public function getRegist(){
		$data                 = array();
        $clsDoorcard          = new DoorcardModel();
		$data['date_formats'] = Config::get('constants.MD_TOUCHTIME_FORMAT');
		$data['error']['error_door_format_required']    = trans('validation.error_door_format_required');
        $data['door']             = $clsDoorcard->getLastRow();
        if(isset($data['door']->md_id)) 
           return view('backend.door.edit',$data);           
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
            'md_card_no_row'        => Input::get('md_card_no_row'),                        
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
    public function getEdit($id){
        $data                 = array();
        $clsDoorcard          = new DoorcardModel();
        $data['date_formats'] = Config::get('constants.MD_TOUCHTIME_FORMAT');
        $data['error']['error_door_format_required']    = trans('validation.error_door_format_required');
        $data['door']             = $clsDoorcard->get_by_id($id);
        return view('backend.door.edit',$data);                   
    }
    public function postEdit($id)
    {
        $clsDoorcard      = new DoorcardModel();
        $inputs         = Input::all();
        $validator      = Validator::make($inputs, $clsDoorcard->Rules(), $clsDoorcard->Messages());
        if ($validator->fails()) {
            return redirect()->route('backend.door.edit', [$id])->withErrors($validator)->withInput();
        }
        // update
        $dataUpdate = array(
            'md_card_no_row'        => Input::get('md_card_no_row'),                        
            'md_door_row'           => Input::get('md_door_row'), 
            'md_door_format'        => Input::get('md_door_format'),
            'md_touchtime_row'      => Input::get('md_touchtime_row'),
            'md_touchtime_format'   => Input::get('md_touchtime_format'),   
            'last_date'             => date('Y-m-d H:i:s'),
            'last_kind'             => UPDATE,
            'last_ipadrs'           => $_SERVER['REMOTE_ADDR'],
            'last_user'             => Auth::user()->u_id 
        );

        if ( $clsDoorcard->update($id, $dataUpdate) ) {
            Session::flash('success', trans('common.msg_edit_success'));
        } else {
            Session::flash('danger', trans('common.msg_edit_danger'));
        }
        return redirect()->route('backend.door.edit', [$id]);
    }
    public function importDoorcard()
    {
    	$dataInput              = array();
        $clsDoorcard            = new DoorcardImportModel();
        $clsDoorcardModel       = new DoorcardModel();
        $inputs                 = Input::all();
        $rules                  = $clsDoorcard->Rules();
        if(!Input::hasFile('file_path')){
            unset($rules['file_path']);
            unset($rules['file_path']);
        }
        $validator              = Validator::make($inputs, $rules, $clsDoorcard->Messages());
        if ($validator->fails()) {
            return redirect()->route('backend.door.index')->withErrors($validator)->withInput();
        }
        if (Input::hasFile('file_path'))
        {
            $upload_file = Input::file('file_path');
            $extFile  = $upload_file->getClientOriginalExtension();

            if(!empty(Input::get('td_dataname'))){
               $fn = Input::get('td_dataname').'_'.rand(time(),time()).'.'.$extFile;
            }else{
                $fn       = 'file'.'_'.rand(time(),time()).'.'.$extFile;
            }

            $path = '/uploads/';
            $upload_file->move(public_path().$path, $fn);                  
            Session::flash('success', trans('common.msg_regist_success'));                
        }else Session::flash('danger', trans('common.msg_regist_danger'));
        return redirect()->route('backend.door.index');
    }
    public function getDelete($dataname)
    {
    	$clsDoorcard            = new DoorcardImportModel();        
        if ( $clsDoorcard->delete($dataname) ) {
            Session::flash('success', trans('common.msg_delete_success'));
        } else {
            Session::flash('danger', trans('common.msg_delete_danger'));
        }
        return redirect()->route('backend.door.index');
    }
}