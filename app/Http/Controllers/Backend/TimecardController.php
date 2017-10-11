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
        $data['timecards']         = $clsTimecard->get_all();
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
            unset($rules['file_path']);
        }
        $validator              = Validator::make($inputs, $rules, $clsTimecard->Messages());
        if ($validator->fails()) {
            return redirect()->route('backend.timecard.index')->withErrors($validator)->withInput();
        }
        if (Input::hasFile('file_path'))
        {
            $upload_file = Input::file('file_path');
            $extFile  = $upload_file->getClientOriginalExtension();

            if(!empty(Input::get('tt_dataname'))){
               /* $flag  = $clsTimecard->checkFileValid(trim(Input::get('file_path')));
                if($flag == true){
                    $fn = Input::get('tt_dataname').'.'.$extFile;
                }else{
                    $fn = Input::get('tt_dataname').'_'.rand(time(),time()).'.'.$extFile;
                }*/
                $fn = Input::get('tt_dataname').'_'.rand(time(),time()).'.'.$extFile;
            }else{
                $fn       = 'file'.'_'.rand(time(),time()).'.'.$extFile;
            }

            $path = '/uploads/';
            $upload_file->move(public_path().$path, $fn);
            $data = array();
           /* Excel::batch(public_path().$path, function($rows,$fn) {              
                $rows->each(function($row) {     
                    echo $row->staff_id;
                     $arrData[]  =  $row->staff_id;
                     $arrData[$row->staff_id]['tt_staff_id_no']  = $row->staff_id;
                     $arrData[$row->staff_id]['tt_date']  = $row->date;
                     $arrData[$row->staff_id]['tt_gotime']  = $row->gotime;
                     $arrData[$row->staff_id]['tt_backtime']  = $row->backtime;         
                     
                });

            });
            Excel::load(public_path().$path.$fn, function($reader) {
                

                // Getting all results
                $results = $reader->get();

                // ->all() is a wrapper for ->get() and will work the same
                $results = $reader->all();
                $arrData = $results->toArray();         
                


            }, 'UTF-8');  */
            $timecardModel = $clsTimecardModel->get_last_insert();
            $i=0;
            Excel::filter('chunk')->load(public_path().$path.$fn)->chunk(250, function($results)
            {
                    foreach($results as $row)
                    {

                        $data=$row->toArray();  
                        print_r($data);     
                        
                        print_r($timecardModel);                
                       /* $clsTimecard      = new TimecardImportModel();
                        $dataInsert             = array(
                            'tt_staff_id_no'    => $data['staff_id'],
                            'tt_date'           => date('Y-m-d',$data['date']),           
                            'tt_gotime'         => $data['gotime'], 
                            'tt_backtime'       => $data['backtime'],
                            'tt_dataname'       => Input::get('tt_dataname'),
                            'last_date'         => date('Y-m-d H:i:s'),
                            //'last_kind'         => INSERT,
                            'last_ipadrs'       => CLIENT_IP_ADRS,
                            'last_user'         => Auth::user()->u_id            
                        );
                        $clsTimecard->insert($dataInsert);*/

                    }                    
            });  
                            
        }

    }

	public function getRegist(){
        $data =array();
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
}