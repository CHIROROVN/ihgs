<?php 
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Backend\BackendController;
use App\Http\Models\DoorcardModel;
use App\Http\Models\DoorcardImportModel;
use Auth;
use Input;
use Validator;
use URL;
use Session;
use Config;

class DoorController extends BackendController
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
    }

    public function index(){

        $data =array();
        $clsDoorcard            = new DoorcardImportModel();
        $clsDoorcardModel       = new DoorcardModel();
        $data['door']           = $clsDoorcardModel->getLastRow();   
        $data['doorcards']      = $clsDoorcard->get_all_by_dataname(); 
        $data['error']['error_td_dataname_required']    = trans('validation.error_td_dataname_required');
        $data['error']['error_file_path_required']      = trans('validation.error_file_path_required');
        $data['error']['error_timecard_file_csv']       = trans('validation.error_timecard_file_csv');
        $data['error']['msg_import_setting_danger']     = trans('common.msg_import_setting_danger');
        return view('backend.door.index',$data);
    }

    public function getRegist(){
        $data                 = array();
        $clsDoorcard          = new DoorcardModel();
        $data['date_formats'] = Config::get('constants.MD_TOUCHTIME_FORMAT');
        $data['time_formats'] = Config::get('constants.MT_TIME_FORMAT');
        $data['short_dates']   = Config::get('constants.MD_SHORT_DATE');
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
            'md_touchday_row'       => Input::get('md_touchday_row'),
            'md_touchday_format'    => Input::get('md_touchday_format'),
            'md_touchtime_row'      => Input::get('md_touchtime_row'),
            'md_touchtime_format'   => Input::get('md_touchtime_format'),   
            'md_touchdate_row'      => Input::get('md_touchdate_row'),
            'md_touchdate_format'   => Input::get('md_touchdate_format'),            
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
        $data['time_formats'] = Config::get('constants.MT_TIME_FORMAT');
        $data['short_dates']   = Config::get('constants.MD_SHORT_DATE');
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
            'md_touchday_row'       => Input::get('md_touchday_row'),
            'md_touchday_format'    => Input::get('md_touchday_format'),
            'md_touchtime_row'      => Input::get('md_touchtime_row'),
            'md_touchtime_format'   => Input::get('md_touchtime_format'),   
            'md_touchdate_row'      => Input::get('md_touchdate_row'),
            'md_touchdate_format'   => Input::get('md_touchdate_format'),     
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
        $inputs                 = Input::all();               
        if (Input::hasFile('file_path'))
        {   $path   = Input::file('file_path')->getRealPath();
            $data   = array();
            $ary[] = "ASCII";$ary[] = "JIS";$ary[] = "EUC-JP";$ary[] = "Shift-JIS";$ary[] = "eucjp-win";$ary[] = "sjis-win";          
            $string = file_get_contents($path); 
            if(mb_detect_encoding($string) !=='UTF-8')
            { 
                $str = mb_convert_encoding($string, "UTF-8", mb_detect_encoding($string, $ary));            
                $convert = explode("\n", $str);                
                for ($i=1;$i<count($convert);$i++)  
                {
                    $arrTempt = explode(",",$convert[$i]);
                    if(isset($arrTempt[$inputs['md_card_no_row']-1]) && !empty(str_replace('"','',$arrTempt[$inputs['md_card_no_row']-1])) && !empty(str_replace('"','',$arrTempt[$inputs['md_door_row']-1]))){
                        if(isset($inputs['md_touchdate_row']) && $inputs['md_touchdate_row'] >0)                                            
                            $touchtime    = isset($arrTempt[$inputs['md_touchdate_row']-1])?date("Y-m-d  H:i:s",strtotime($arrTempt[$inputs['md_touchdate_row']-1])):date("Y-m-d H:i:s");
                        else{                                                                  
                               $time           = isset($arrTempt[$inputs['md_touchtime_row']-1])?date("H:i:s",strtotime($arrTempt[$inputs['md_touchtime_row']-1])):'00:00:00';                       
                               $date           = isset($arrTempt[$inputs['md_touchday_row']-1])?date("Y-m-d", strtotime(trim($arrTempt[$inputs['md_touchday_row']-1]))):date("Y-m-d"); 
                               $touchtime      = $date.' '.$time;                     
                            }                                                                                                                          
                        $dataInsert             = array(
                            'td_card'           => str_replace('"','',$arrTempt[$inputs['md_card_no_row']-1]),
                            'td_door'           => isset($arrTempt[$inputs['md_door_row']-1])?str_replace('"','',$arrTempt[$inputs['md_door_row']-1]):'',           
                            'td_touchtime'      => $touchtime,                         
                            'td_dataname'       => Input::get('td_dataname'),
                            'last_date'         => date('Y-m-d H:i:s'),                        
                            'last_ipadrs'       => CLIENT_IP_ADRS,
                            'last_user'         => Auth::user()->u_id            
                        );     
                            if(!empty($dataInsert['td_card']))      $clsDoorcard->insert($dataInsert);   
                    }    
                }
            }
                                   
          /*if(!empty($data) && count($data) >0){                
                foreach ($data as $value) {
                   if(isset($value[$inputs['md_card_no_row']]) && !empty($value[$inputs['md_card_no_row']]) && !empty($value[$inputs['md_door_row']])){
                        if(isset($inputs['md_touchdate_row']) && $inputs['md_touchdate_row'] >0)                                            
                            $touchtime    = isset($value[$inputs['md_touchdate_row']])?date("Y-m-d  H:i:s",strtotime($value[$inputs['md_touchdate_row']])):date("Y-m-d H:i:s");
                        else{                                                                  
                               $time           = isset($value[$inputs['md_touchtime_row']])?date("H:i:s",strtotime($value[$inputs['md_touchtime_row']])):'00:00:00';                       
                               $date           = isset($value[$inputs['md_touchday_row']])?date("Y-m-d", strtotime(trim($value[$inputs['md_touchday_row']]))):date("Y-m-d"); 
                               $touchtime      = $date.' '.$time;                     
                            }                                                                                                                          
                        $dataInsert             = array(
                            'td_card'           => $value[$inputs['md_card_no_row']],
                            'td_door'           => isset($value[$inputs['md_door_row']])?$value[$inputs['md_door_row']]:'',           
                            'td_touchtime'      => $touchtime,                         
                            'td_dataname'       => Input::get('td_dataname'),
                            'last_date'         => date('Y-m-d H:i:s'),                        
                            'last_ipadrs'       => CLIENT_IP_ADRS,
                            'last_user'         => Auth::user()->u_id            
                        );     
                            if(!empty($dataInsert['td_card']))      $clsDoorcard->insert($dataInsert); 
                   }                        
                   
                } 
                Session::flash('success', trans('common.msg_regist_success'));             
            }else Session::flash('danger', trans('common.msg_regist_danger'));            
            unset($data); unset($date_formats);unset($inputs);  */            
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