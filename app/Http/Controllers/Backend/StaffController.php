<?php namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Backend\BackendController;
use App\Http\Requests;
use Illuminate\Http\Request;
use Auth;
use Hash;
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

class StaffController extends BackendController
{
	public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
    }
	
	public function index(){
		$data =array();
		$clsStaff          = new StaffModel();
        $data['staffs']    = $clsStaff->get_all();   
		return view('backend.staff.index',$data);
	}
	public function getRegist(){
		$clsBelong = new BelongModel();
		$divisions = $clsBelong->list_division_tree(); 
		return view('backend.staff.regist', compact('divisions'));
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
            'staff_card1'      => Input::get('staff_card1'),
            'staff_card2'      => Input::get('staff_card2'),
            'staff_card3'      => Input::get('staff_card3'),
            'staff_card4'      => Input::get('staff_card4'),
            'staff_card5'      => Input::get('staff_card5'),
            'staff_card6'      => Input::get('staff_card6'),
            'staff_card7'      => Input::get('staff_card7'),
            'staff_card8'      => Input::get('staff_card8'),
            'staff_card9'      => Input::get('staff_card9'),
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

	public function import(){
		return view('backend.staff.import');
	}

	public function search(){
		return view('backend.staff.search');
	}

	public function getDelete()
	{

	}

	public function getEdit()
	{
		
	}
}