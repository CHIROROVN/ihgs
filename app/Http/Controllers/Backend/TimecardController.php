<?php namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Backend\BackendController;
use Auth;
use App\Http\Models\TimecardModel;
use App\Http\Models\TimecardImportModel;
use App\Http\Models\FileModel;
use Input;
use Validator;
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
        //$clsTimecard              = new TimecardImportModel();
        $clsTimecardModel         = new TimecardModel();
        $clsFile                  = new FileModel();
        //$data['timecards']      = $clsTimecard->get_all_by_dataname(); 
        $data['time']             = $clsTimecardModel->getLastRow();      
        $data['timecards']        = $clsFile->get_all_by_type(2);
        $data['error']['error_tt_dataname_required']    = trans('validation.error_tt_dataname_required');
        $data['error']['error_file_path_required']      = trans('validation.error_file_path_required');
        $data['error']['error_timecard_file_csv']      = trans('validation.error_timecard_file_csv');
        $data['error']['msg_import_setting_danger']     = trans('common.msg_import_setting_danger');
        return view('backend.timecard.index',$data);
    }
     public function import()
    {
        $dataInput              = array();
        $clsTimecard            = new TimecardImportModel();
        $inputs                 = Input::all();  
        
        if (Input::hasFile('file_path'))
        {    
            $path = Input::file('file_path')->getRealPath();
            $data   = array();
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
                if(isset($arrTempt[$inputs['mt_staff_id_row']-1]) && !empty(str_replace('"','',$arrTempt[$inputs['mt_staff_id_row']-1]))){
                    $dataInsert = array(
                                            'tt_staff_id_no'    => $arrTempt[$inputs['mt_staff_id_row']-1],
                                            'tt_date'           => isset($arrTempt[$inputs['mt_date_row']-1])?date("Y-m-d",strtotime($arrTempt[$inputs['mt_date_row']-1])):'',           
                                            'tt_gotime'         => isset($arrTempt[$inputs['mt_gotime_row']-1])?date("H:i:s",strtotime($arrTempt[$inputs['mt_gotime_row']-1])):'00:00:00', 
                                            'tt_backtime'       => isset($arrTempt[$inputs['mt_backtime_row']-1])?date("H:i:s",strtotime($arrTempt[$inputs['mt_backtime_row']-1])):'00:00:00',
                                            'tt_dataname'       => $inputs['tt_dataname'],
                                            'last_date'         => date('Y-m-d H:i:s'),                        
                                            'last_ipadrs'       => CLIENT_IP_ADRS,
                                            'last_user'         => Auth::user()->u_id            
                    );                                                                                                                                                               
                    if(!empty($dataInsert['tt_staff_id_no']))              $clsTimecard->insert($dataInsert);
                }  
            }             
            Session::flash('success', trans('common.msg_regist_success'));                
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
        $clsTimecard    = new TimecardModel();
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
        $clsTimecard    = new TimecardModel();
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
    public function getList($staff_id,$year,$month)
    {
        $clsTimecard        = new TimecardImportModel();
        $timecard           = $clsTimecard->getList($staff_id,$year,$month);        
        $data['timecards']  = isset($timecard['timecards'])?$timecard['timecards']:array();
        $data['doorcards']  = isset($timecard['doorcards'])?$timecard['doorcards']:array();
        $data['pcs']        = isset($timecard['pcs'])?$timecard['pcs']:array();
        return view('backend.timecard.list', $data);
    } 
}