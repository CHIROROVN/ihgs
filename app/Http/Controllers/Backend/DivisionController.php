<?php 
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Backend\BackendController;
use App\Http\Requests;
use Illuminate\Http\Request;
use Auth;
use Hash;
use App\User;
use App\Http\Models\BelongModel;
use Form;
use Html;
use Input;
use Validator;
use URL;
use Session;
use Config;

class DivisionController extends BackendController
{
	/*
	public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
    }
	*/
	public function index(){
		$data =array();
		//$clsBelong          = new BelongModel();
        //$data['belongs']    = $clsBelong->get_all();

		return view('backend.division.index',$data);
	}
	public function getRegist(){
		return view('backend.division.regist');
	}
}