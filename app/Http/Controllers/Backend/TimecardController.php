<?php namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Backend\BackendController;
use Auth;
//use App\User;
use App\Http\Models\TimecardModel;
use App\Http\Models\TimecardImportModel;
use Html;
use Input;
use Validator;
use URL;
use Session;
use Config;
use Excel;

class TimecardController extends BackendController
{
    
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
    }
    
    public function index(){
        $data =array();
        $clsTimecard               = new TimecardImportModel();
        $data['timecards']         = $clsTimecard->get_all_by_dataname();
        $data['error']['error_tt_dataname_required']    = trans('validation.error_tt_dataname_required');
        $data['error']['error_file_path_required']      = trans('validation.error_file_path_required');
        return view('backend.timecard.index',$data);
    }

    public function import()
    {

        $dataInput              = array();
        $clsTimecard            = new TimecardImportModel();
        $clsTimecardModel       = new TimecardModel();
        $inputs                 = Input::all();
        $rules                  = $clsTimecard->Rules();
        if(!Input::hasFile('file_path')){
            unset($rules['file_path']);            
        }else{
            $upload_file = Input::file('file_path');
            $extFile  = $upload_file->getClientOriginalExtension();
            if($extFile == 'csv' || $extFile == 'CSV' || $extFile == 'xls' || $extFile == 'xlsx'){
                unset($rules['file_csv']);
            }
        }

        $validator              = Validator::make($inputs, $rules, $clsTimecard->Messages());
        if ($validator->fails()) {
            return redirect()->route('backend.timecard.index')->withErrors($validator)->withInput();
        }

        $timecard  = $clsTimecardModel->get_last_insert();

        if(!isset($timecard[0]->mt_gotime_row)){
            Session::flash('danger', trans('common.msg_import_setting_danger'));
            return redirect()->route('backend.timecard.index');
        }else{
            $arrConfig = array('mt_staff_id_row'=> isset($timecard[0]->mt_staff_id_row)?$timecard[0]->mt_staff_id_row-1:1,
                               'mt_date_row'=> isset($timecard[0]->mt_date_row)?$timecard[0]->mt_date_row-1:1,
                               'mt_gotime_row'=> isset($timecard[0]->mt_gotime_row)?$timecard[0]->mt_gotime_row-1:1, 
                               'mt_backtime_row'=> isset($timecard[0]->mt_backtime_row)?$timecard[0]->mt_backtime_row-1:1, 
                        );
        }   
        
        if (Input::hasFile('file_path'))
        {
            //ini_set('max_execution_time', 3600);
            ini_set('memory_limit', '512M');           
            $fn = Input::get('tt_dataname').'_'.rand(time(),time()).'.'.$extFile;          
            
            $path = '/uploads/';          
            $upload_file->move(public_path().$path, $fn);                             
            $data = array();           
            $data = Excel::load(public_path().$path.$fn, function($reader) {
            }, 'UTF-8')->get();                      
            $date_formats  = Config::get('constants.DATE_FORMAT');
            $time_formats  = Config::get('constants.TIME_FORMAT');          
            if(!empty($data) && $data->count()){      
                $data = $data->toArray();                                        
                foreach ($data as $key => $value) {    
                   foreach($value as $var){                       
                        $arr = (is_array($var))?array_values($var):array();                                                               
                        if(count($arr) <1) continue;
                        if(!empty($arr[$arrConfig['mt_gotime_row']]) && !empty($arr[$arrConfig['mt_backtime_row']]))  
                        {                      
                            $dataInsert = array(
                                                    'tt_staff_id_no'    => isset($arr[$arrConfig['mt_staff_id_row']])?$arr[$arrConfig['mt_staff_id_row']]:'',
                                                    'tt_date'           => isset($arr[$arrConfig['mt_date_row']])?date("Y-m-d",strtotime($arr[$arrConfig['mt_date_row']])):'',   
                                                    'tt_dataname'       => Input::get('tt_dataname'),
                                                    'last_date'         => date('Y-m-d H:i:s'),                        
                                                    'last_ipadrs'       => CLIENT_IP_ADRS,
                                                    'last_user'         => Auth::user()->u_id            
                            );                          
                            if(isset($arr[$arrConfig['mt_gotime_row']]) && !empty($arr[$arrConfig['mt_gotime_row']])) 
                                $dataInsert['tt_gotime']  = date("H:i:s",strtotime($arr[$arrConfig['mt_gotime_row']]));
                            if(isset($arr[$arrConfig['mt_backtime_row']]) && !empty($arr[$arrConfig['mt_backtime_row']])) 
                                $dataInsert['tt_backtime']  = date("H:i:s",strtotime($arr[$arrConfig['mt_backtime_row']]));
                            $clsTimecard->insert($dataInsert);
                        }    
                    }
                }   
                Session::flash('success', trans('common.msg_regist_success'));             
            }else Session::flash('danger', trans('common.msg_regist_danger'));          
            unset($data);unset($date_formats);unset($time_formats);                
        }else Session::flash('danger', trans('common.msg_regist_danger'));         
       return redirect()->route('backend.timecard.index');
    }

    public function getRegist(){
        $data =array();
        $clsTimecard          = new TimecardModel();
        $timecard             = $clsTimecard->get_last_insert();
        $data['date_formats'] = Config::get('constants.MT_DATE_FORMAT');
        $data['time_formats'] = Config::get('constants.MT_TIME_FORMAT'); 
        if(isset($timecard[0]->mt_id))
        {
            $data['timecard']     = $clsTimecard->get_by_id($timecard[0]->mt_id);
            return view('backend.timecard.edit', $data);
        }                   
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
        if ( $clsTimecard->insert($dataInsert)  ) {
            Session::flash('success', trans('common.msg_regist_success'));
        } else {
            Session::flash('danger', trans('common.msg_regist_danger'));
        }        
        $timecard = $clsTimecard->get_last_insert(Input::get('mt_staff_id_row'));        
        $id       = $timecard[0]->mt_id;
        return redirect()->route('backend.timecard.edit',[$id]);
    }
    /**
     * 
     */
    public function getEdit($id)
    {
        $clsTimecard          = new TimecardModel();
        $data['timecard']     = $clsTimecard->get_by_id($id);
        $data['date_formats'] = Config::get('constants.MT_DATE_FORMAT');
        $data['time_formats'] = Config::get('constants.MT_TIME_FORMAT');               
        return view('backend.timecard.edit', $data);
    }
    public function postEdit($id)
    {
        $clsTimecard          = new TimecardModel();
        $inputs         = Input::all();
        $validator      = Validator::make($inputs, $clsTimecard->Rules(), $clsTimecard->Messages());
        if ($validator->fails()) {
            return redirect()->route('backend.timecard.edit', [$id])->withErrors($validator)->withInput();
        }

        // update
        $dataUpdate = array(
            'mt_staff_id_row'       => Input::get('mt_staff_id_row'),                        
            'mt_date_row'           => Input::get('mt_date_row'), 
            'mt_date_format'        => Input::get('mt_date_format'),
            'mt_gotime_row'         => Input::get('mt_gotime_row'),
            'mt_gotime_format'      => Input::get('mt_gotime_format'),
            'mt_backtime_row'       => Input::get('mt_backtime_row'),
            'mt_backtime_format'    => Input::get('mt_backtime_format'),
            'last_date'             => date('Y-m-d H:i:s'),
            'last_kind'             => UPDATE,
            'last_ipadrs'           => $_SERVER['REMOTE_ADDR'],
            'last_user'             => Auth::user()->u_id 
        );

        if ( $clsTimecard->update($id, $dataUpdate) ) {
            Session::flash('success', trans('common.msg_edit_success'));
        } else {
            Session::flash('danger', trans('common.msg_edit_danger'));
        }
        return redirect()->route('backend.timecard.edit', [$id]);
    }   
    public function getDelete($dataname)
    {
        $clsTimecard            = new TimecardImportModel();       
        if ( $clsTimecard->delete($dataname) ) {
            Session::flash('success', trans('common.msg_delete_success'));
        } else {
            Session::flash('danger', trans('common.msg_delete_danger'));
        }
        return redirect()->route('backend.timecard.index');
    } 
}