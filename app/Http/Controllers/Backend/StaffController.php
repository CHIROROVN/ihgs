<?php namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Backend\BackendController;
use Auth;
use App\User;
use App\Http\Models\StaffModel;
use App\Http\Models\BelongModel;
use Form;
use Html;
use Input;
use Validator;
use URL;
use Session;
use Config;
use Excel;

class StaffController extends BackendController
{
	public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
    }
	
	public function index(){
		$data =array();
        $inputs            = Input::all();
		$clsStaff          = new StaffModel();      
        $data['staffs']    = $clsStaff->get_all(Input::get('staff_belong', null),Input::get('txtstaff_name', null),Input::get('txtstaff_id_no', null));   
        $data['staffs']['page']         = (isset($_GET['page'])) ? $_GET['page'] : 1;
        $data['staffs']['start']        = (($data['staffs']['page'] - 1) * LIMIT_PAGE) +1 ;
        $data['staffs']['total_page']   = ceil($data['staffs']['count']/ LIMIT_PAGE) ;
        $data['staffs']['end']          = ($data['staffs']['page']==$data['staffs']['total_page'])?$data['staffs']['count']: $data['staffs']['start'] + LIMIT_PAGE -1;
        
		return view('backend.staff.index',$data);
	}
	public function getRegist(){
		$clsBelong            = new BelongModel();
		$data['divisions']    = $clsBelong->list_division_tree(); 
        $data['error']['error_staff_id_no_required'] = trans('validation.error_staff_id_no_required');
        $data['error']['error_staff_name_required']  = trans('validation.error_staff_name_required');
		return view('backend.staff.regist', $data);
	}

	public function postRegist()
    {
        $clsStaff      = new StaffModel();
        $inputs         = Input::all();
        $validator      = Validator::make($inputs, $clsStaff ->Rules(), $clsStaff ->Messages());
        if ($validator->fails()) {
            return redirect()->route('backend.staff.regist')->withErrors($validator)->withInput();
        }
        // insert
        
        $dataInsert             = array(
            'staff_id_no'       => Input::get('staff_id_no'),
            'staff_name'        => Input::get('staff_name'),           
            'staff_belong'      => Input::get('staff_belong'),
            'staff_card1'       => Input::get('staff_card1'),
            'staff_card2'       => Input::get('staff_card2'),
            'staff_card3'       => Input::get('staff_card3'),
            'staff_card4'       => Input::get('staff_card4'),
            'staff_card5'       => Input::get('staff_card5'),
            'staff_card6'       => Input::get('staff_card6'),
            'staff_card7'       => Input::get('staff_card7'),
            'staff_card8'       => Input::get('staff_card8'),
            'staff_card9'       => Input::get('staff_card9'),
            'staff_card10'      => Input::get('staff_card10'),
            'staff_pc1'         => Input::get('staff_pc1'),
            'staff_pc2'         => Input::get('staff_pc2'),
            'staff_pc3'         => Input::get('staff_pc3'),
            'staff_pc4'         => Input::get('staff_pc4'),
            'staff_pc5'         => Input::get('staff_pc5'),
            'staff_pc6'         => Input::get('staff_pc6'),
            'staff_pc7'         => Input::get('staff_pc7'),
            'staff_pc8'         => Input::get('staff_pc8'),
            'staff_pc9'         => Input::get('staff_pc9'),
            'staff_pc10'        => Input::get('staff_pc10'),
            'last_date'         => date('Y-m-d H:i:s'),
            'last_kind'         => INSERT,
            'last_ipadrs'       => CLIENT_IP_ADRS,
            'last_user'         => Auth::user()->u_id            
        );
        
        if ( $clsStaff ->insert($dataInsert) ) {
            Session::flash('success', trans('common.msg_regist_success'));
        } else {
            Session::flash('danger', trans('common.msg_regist_danger'));
        }
        return redirect()->route('backend.staff.index');
    }

	public function getImport(){
       $data['error']['error_file_path_required']      = trans('validation.error_file_path_required');
       return view('backend.staff.import',$data);       
	}

    public function postImport(){
       $dataInput              = array();
       $clsStaff               = new StaffModel();
        $clsBelong             = new BelongModel();
        $inputs                = Input::all(); 
        $staff_id_no           = Input::get('staff_id_no');
        $staff_name            = Input::get('staff_name');
        $staff_belong          = Input::get('staff_belong');
        $staff_card            = Input::get('staff_card');
        $staff_pc              = Input::get('staff_pc');
        $rules                 = $clsStaff->RulesImport();
        $data['error']['error_file_path_required']      = trans('validation.error_file_path_required');
        if(!Input::hasFile('file_path')){
            unset($rules['file_path']);
        }else{
            $upload_file = Input::file('file_path');
            $extFile  = $upload_file->getClientOriginalExtension();
            if($extFile == 'csv' || $extFile == 'CSV' || $extFile == 'xls' || $extFile == 'xlsx'){
                unset($rules['file_csv']);
            }
        }
        $validator              = Validator::make($inputs, $rules, $clsStaff->MessagesImport());
        if ($validator->fails()) {
            return redirect()->route('backend.staff.import')->withErrors($validator)->withInput();
        }

        if (Input::hasFile('file_path'))
        {
            $file_upload = Input::file('file_path');
            $path = Input::file('file_path')->getRealPath();
            $data   = array();
            $data  = $this->readFileCsv($path); 
            if(!empty($data) && count($data)){ 
               foreach ($data as $key => $value) {
                  
                  $staff_belong_id   =  (isset($value[$staff_belong]) && !empty($value[$staff_belong]))?$clsBelong->get_by_belong_name($value[$staff_belong]):'NULL';
                  if(isset($staff_belong->belong_id)){                                   
                        $dataInsert             = array(
                            'staff_id_no'       => isset($value[$staff_id_no])?$value[$staff_id_no]:'',
                            'staff_name'        => isset($value[$staff_name])?$value[$staff_name]:'',                        
                            'staff_belong'      => $staff_belong_id->belong_id,
                            'staff_card1'       => isset($value[$staff_card])?$value[$staff_card]:'',                      
                            'staff_pc1'         => isset($value[$staff_pc])?$value[$staff_pc]:'',                       
                            'last_date'         => date('Y-m-d H:i:s'), 
                            'last_kind'         => INSERT,                       
                            'last_ipadrs'       => CLIENT_IP_ADRS,
                            'last_user'         => Auth::user()->u_id            
                        );  
                    }else{
                        $dataInsert             = array(
                            'staff_id_no'       => isset($value[$staff_id_no])?$value[$staff_id_no]:'',
                            'staff_name'        => isset($value[$staff_name])?$value[$staff_name]:'',                                                    
                            'staff_card1'       => isset($value[$staff_card])?$value[$staff_card]:'',                      
                            'staff_pc1'         => isset($value[$staff_pc])?$value[$staff_pc]:'',                       
                            'last_date'         => date('Y-m-d H:i:s'), 
                            'last_kind'         => INSERT,                       
                            'last_ipadrs'       => CLIENT_IP_ADRS,
                            'last_user'         => Auth::user()->u_id            
                        );  
                    } 
                    if(!empty($dataInsert['staff_id_no']) && !empty($dataInsert['staff_name'])){
                        $clsStaff->insert($dataInsert);     
                    }    
               }
                Session::flash('success', trans('common.msg_regist_success'));
            }else{
                 Session::flash('danger', trans('common.msg_regist_danger'));
            }    
            /*ini_set('max_execution_time', 100);
            ini_set('memory_limit', '512M');
            $fn          = 'file'.'_'.rand(time(),time()).'.'.$extFile;                        
            $path        = '/uploads/';
            $upload_file->move(public_path().$path, $fn);
            $data = array(); 
            $data = Excel::load(public_path().$path.$fn, function($reader) {
            }, 'UTF-8')->get();   
            $data = $data->toArray();           
            if(!empty($data) && count($data) >0){                    
                foreach ($data[0] as $key => $value) {                     
                    $arr  =array(); 
                    $arr = (is_array($value))?array_values($value):$value;                
                  
                    $staff_belong   =  isset($arr[$staff_belong])?$clsBelong->get_by_belong_name($arr[$staff_belong]):'NULL'; 

                    if(isset($staff_belong->belong_id)){                                   
                        $dataInsert             = array(
                            'staff_id_no'       => isset($arr[$staff_id_no])?$arr[$staff_id_no]:'',
                            'staff_name'        => isset($arr[$staff_name])?$arr[$staff_name]:'',                        
                            'staff_belong'      => $staff_belong->belong_id,
                            'staff_card1'       => isset($arr[$staff_card])?$arr[$staff_card]:'',                      
                            'staff_pc1'         => isset($arr[$staff_pc])?$arr[$staff_pc]:'',                       
                            'last_date'         => date('Y-m-d H:i:s'), 
                            'last_kind'         => INSERT,                       
                            'last_ipadrs'       => CLIENT_IP_ADRS,
                            'last_user'         => Auth::user()->u_id            
                        );  
                    }else{
                        $dataInsert             = array(
                            'staff_id_no'       => isset($arr[$staff_id_no])?$arr[$staff_id_no]:'',
                            'staff_name'        => isset($arr[$staff_name])?$arr[$staff_name]:'',                                                    
                            'staff_card1'       => isset($arr[$staff_card])?$arr[$staff_card]:'',                      
                            'staff_pc1'         => isset($arr[$staff_pc])?$arr[$staff_pc]:'',                       
                            'last_date'         => date('Y-m-d H:i:s'), 
                            'last_kind'         => INSERT,                       
                            'last_ipadrs'       => CLIENT_IP_ADRS,
                            'last_user'         => Auth::user()->u_id            
                        );  
                    }    
                    echo "<pre>";print_r($dataInsert); echo "</pre>";          
                    $clsStaff->insert($dataInsert);
                }//end foreach
                Session::flash('success', trans('common.msg_regist_success'));
            }//end if empty
            else Session::flash('danger', trans('common.msg_regist_danger'));  
            */     
        }//end if upload   
        else Session::flash('danger', trans('common.msg_regist_danger'));  
        return redirect()->route('backend.staff.import'); 
    }

    public function postImport1(){
        $dataInput              = array();
        $clsStaff               = new StaffModel();
        $clsBelong             = new BelongModel(); 
        $inputs                 = Input::all();
        $staff_id_no           = Input::get('staff_id_no');
        $staff_name           = Input::get('staff_name');
        $staff_belong          = Input::get('staff_belong');
        $staff_card            = Input::get('staff_card');
        $staff_pc              = Input::get('staff_pc');
        $rules                 = $clsStaff->RulesImport();
        $data['error']['error_file_path_required']      = trans('validation.error_file_path_required');
        if(!Input::hasFile('file_path')){
            unset($rules['file_path']);            
        }else{
            $upload_file = Input::file('file_path');
            $extFile  = $upload_file->getClientOriginalExtension();
            if($extFile == 'csv' || $extFile == 'CSV' || $extFile == 'xls' || $extFile == 'xlsx'){
                unset($rules['file_csv']);
            }
        }
        $validator              = Validator::make($inputs, $rules,$clsStaff->MessagesImport());
        if ($validator->fails()) {
            return redirect()->route('backend.staff.import')->withErrors($validator)->withInput();
        }
        if (Input::hasFile('file_path'))
        {            
            ini_set('max_execution_time', 300);
            ini_set('memory_limit', '512M');
            $fn          = 'file'.'_'.rand(time(),time()).'.'.$extFile;                        
            $path        = '/uploads/';
            $upload_file->move(public_path().$path, $fn);
            $data = array(); 
            $data = Excel::load(public_path().$path.$fn, function($reader) {
            }, 'UTF-8')->get();   
            $data = $data->toArray();
            if(!empty($data) && count($data) >0){                    
                foreach ($data[0] as $key => $value) {
                    $arr  =array(); 
                    $arr = array_values($value);             
                    
                    $staff_belong   =  isset($arr[$staff_belong])?$clsBelong->get_by_belong_name($arr[$staff_belong]):'NULL'; 
                    if(isset($staff_belong->belong_id)){                                   
                        $dataInsert             = array(
                            'staff_id_no'       => isset($arr[$staff_id_no])?$arr[$staff_id_no]:'',
                            'staff_name'        => isset($arr[$staff_name])?$arr[$staff_name]:'',                        
                            'staff_belong'      => $staff_belong->belong_id,
                            'staff_card1'       => isset($arr[$staff_card])?$arr[$staff_card]:'',                      
                            'staff_pc1'         => isset($arr[$staff_pc])?$arr[$staff_pc]:'',                       
                            'last_date'         => date('Y-m-d H:i:s'), 
                            'last_kind'         => INSERT,                       
                            'last_ipadrs'       => CLIENT_IP_ADRS,
                            'last_user'         => Auth::user()->u_id            
                        );  
                    }else{
                        $dataInsert             = array(
                            'staff_id_no'       => isset($arr[$staff_id_no])?$arr[$staff_id_no]:'',
                            'staff_name'        => isset($arr[$staff_name])?$arr[$staff_name]:'',                                                    
                            'staff_card1'       => isset($arr[$staff_card])?$arr[$staff_card]:'',                      
                            'staff_pc1'         => isset($arr[$staff_pc])?$arr[$staff_pc]:'',                       
                            'last_date'         => date('Y-m-d H:i:s'), 
                            'last_kind'         => INSERT,                       
                            'last_ipadrs'       => CLIENT_IP_ADRS,
                            'last_user'         => Auth::user()->u_id            
                        );  
                    }    
                     
                    $clsStaff->insert($dataInsert);
                }//end foreach
                Session::flash('success', trans('common.msg_regist_success'));
            }//end if empty
            else Session::flash('danger', trans('common.msg_regist_danger'));       
        }//end if upload   
        else Session::flash('danger', trans('common.msg_regist_danger'));  
        return redirect()->route('backend.staff.import'); 
    }

	public function search(){
        $clsBelong = new BelongModel();
        $data['divisions'] = $clsBelong->list_division_tree(); 
		return view('backend.staff.search',$data);
	}

	public function getDelete($id)
	{
        $clsStaff      = new StaffModel();   
        $dataUpdate             = array(
            'last_date'         => date('Y-m-d H:i:s'),
            'last_kind'         => DELETE,
            'last_ipadrs'       => $_SERVER['REMOTE_ADDR'],
            'last_user'         => Auth::user()->u_id 
        );   
        if ( $clsStaff->update($id,$dataUpdate) ) {
            Session::flash('success', trans('common.msg_delete_success'));
        } else {
            Session::flash('danger', trans('common.msg_delete_danger'));
        }
        return redirect()->route('backend.staff.index');
	}

	public function getEdit($id)
	{
        $clsStaff           = new StaffModel();
        $clsBelong          = new BelongModel();
        $data['divisions']  = $clsBelong->list_division_tree(); 
        $data['staff']      = $clsStaff->get_by_id($id);
		$data['error']['error_staff_id_no_required']      = trans('validation.error_staff_id_no_required');
        $data['error']['error_staff_name_required']       = trans('validation.error_staff_name_required');
        return view('backend.staff.edit', $data);
	}

    public function postEdit($id)
    {
        $clsStaff      = new StaffModel();
        $inputs         = Input::all();
        $validator      = Validator::make($inputs, $clsStaff->Rules(), $clsStaff->Messages());
        if ($validator->fails()) {
            return redirect()->route('backend.staff.edit', [$id])->withErrors($validator)->withInput();
        }

        // update
        $dataUpdate = array(
            'staff_id_no'       => Input::get('staff_id_no'),
            'staff_name'        => Input::get('staff_name'),           
            'staff_belong'      => Input::get('staff_belong'),
            'staff_card1'       => Input::get('staff_card1'),
            'staff_card2'       => Input::get('staff_card2'),
            'staff_card3'       => Input::get('staff_card3'),
            'staff_card4'       => Input::get('staff_card4'),
            'staff_card5'       => Input::get('staff_card5'),
            'staff_card6'       => Input::get('staff_card6'),
            'staff_card7'       => Input::get('staff_card7'),
            'staff_card8'       => Input::get('staff_card8'),
            'staff_card9'       => Input::get('staff_card9'),
            'staff_card10'      => Input::get('staff_card10'),
            'staff_pc1'         => Input::get('staff_pc1'),
            'staff_pc2'         => Input::get('staff_pc2'),
            'staff_pc3'         => Input::get('staff_pc3'),
            'staff_pc4'         => Input::get('staff_pc4'),
            'staff_pc5'         => Input::get('staff_pc5'),
            'staff_pc6'         => Input::get('staff_pc6'),
            'staff_pc7'         => Input::get('staff_pc7'),
            'staff_pc8'         => Input::get('staff_pc8'),
            'staff_pc9'         => Input::get('staff_pc9'),
            'staff_pc10'         => Input::get('staff_pc10'),
            'last_date'             => date('Y-m-d H:i:s'),
            'last_kind'             => UPDATE,
            'last_ipadrs'           => $_SERVER['REMOTE_ADDR'],
            'last_user'             => Auth::user()->u_id 
        );

        if ( $clsStaff->update($id, $dataUpdate) ) {
            Session::flash('success', trans('common.msg_edit_success'));
        } else {
            Session::flash('danger', trans('common.msg_edit_danger'));
        }
        return redirect()->route('backend.staff.index');    
    }   

}