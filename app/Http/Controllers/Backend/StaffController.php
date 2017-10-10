<?php namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Backend\BackendController;
use App\Http\Requests;
use Illuminate\Http\Request;
use Auth;
use Hash;
use App\User;
use App\Http\Models\StaffModel;
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
		return view('backend.staff.regist');
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