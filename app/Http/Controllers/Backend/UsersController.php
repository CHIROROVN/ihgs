<?php namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Backend\BackendController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Models\UserModel;
use Input;
use Validator;
use Session;
use Config;
use Hash;

class UsersController extends BackendController
{
	/*
	|-----------------------------------
	| get user login
	|-----------------------------------
	*/
	public function login(){
		return view('auth.login');
	}

	/*
	|-----------------------------------
	| post user login
	|-----------------------------------
	*/
	public function postLogin(){
		$clsUser            = new UserModel();
		$validator = Validator::make(Input::all(), $clsUser->RulesLogin(), $clsUser->MessagesLogin());

		if ($validator->fails()) {
			return redirect()->route('auth.login')->withErrors($validator)->withInput();
		}
		//last_kind insert
		$login1['u_login'] =  Input::get('u_login');
		$login1['password'] =  Input::get('u_passwd');
		$login1['last_kind'] =  INSERT;

		//last_kind update
		$login2['u_login'] =  Input::get('u_login');
		$login2['password'] =  Input::get('u_passwd');
		$login2['last_kind'] =  UPDATE;

		if (Auth::attempt($login1, false) || Auth::attempt($login2, false)) {
			return redirect()->route('backend.search.index');
		}  else {
			Session::flash('danger', trans('common.msg_manage_login_danger'));
			return redirect()->route('auth.login')->withErrors($validator)->withInput();
		}
	}

	/*
	|-----------------------------------
	| get user list
	|-----------------------------------
	*/
	public function index(){
		$clsUser = new UserModel();
		$users = $clsUser->getAllUser();
		return view('backend.users.index', compact('users'));
	}

	/*
	|-----------------------------------
	| get user regist
	|-----------------------------------
	*/
	public function regist(){
		if (Session::has('user')) Session::forget('user');
		return view('backend.users.regist');
	}

	/*
	|-----------------------------------
	| post user regist
	|-----------------------------------
	*/
	public function postRegist(){
		$clsUser            = new UserModel();
		$validator = Validator::make(Input::all(), $clsUser->Rules(), $clsUser->Messages());

		if ($validator->fails()) {
			return redirect()->route('backend.users.regist')->withErrors($validator)->withInput();
		}

		$data['u_name']                 = Input::get('u_name');
		$data['u_login']                = Input::get('u_login');
		$data['u_passwd']               = Hash::make(Input::get('u_passwd'));
		if(!empty(Input::get('u_flag'))){
			$data['u_flag']             = Input::get('u_flag');
		}else{
			$data['u_flag'] = NULL;
		}
		$data['last_ipadrs']            = CLIENT_IP_ADRS;
		$data['last_date']              = date('y-m-d H:i:s');
		$data['last_user']              = Auth::user()->u_id;
		$data['last_kind']              = INSERT;

		Session::put('user', $data);
		return redirect()->route('backend.users.regist_cnf');
	}

	public function registBack(){
		if (Session::has('user')) {
			$user = Session::get('user');
			unset($user['u_passwd']);
			return redirect()->route('backend.users.regist')->withInput($user);
		}else{
			return redirect()->route('backend.users.regist');
		}
	}

	/*
	|-----------------------------------
	| get user regist confirm
	|-----------------------------------
	*/
	public function registCnf(){
		$clsUser                = new UserModel();
		if (Session::has('user')) {
			$user              =  (object) Session::get('user');
			return view('backend.users.regist_cnf', compact('user'));
		}
		return redirect()->route('backend.users.regist');
	}

	/*
	|-----------------------------------
	| get user regist confirm
	|-----------------------------------
	*/
	public function registSave(){
		$clsUser                = new UserModel();
		if (Session::has('user')) {
			$data               =  (array) Session::get('user');
			if ( $clsUser->insert($data) ) {
				Session::forget('user');
				Session::flash('success', trans('common.msg_cts-adm_regist_success'));
				return redirect()->route('backend.users.index');
			} else {
				Session::flash('danger', trans('common.msg_cts-adm_regist_danger'));
				return redirect()->route('backend.users.regist_cnf');
			}
		}else{
			return redirect()->route('backend.users.regist');
		}
	}

	/*
	|-----------------------------------
	| get user edit
	|-----------------------------------
	*/
	public function edit($id){
		$u_id = $id;
		$clsUser                = new UserModel();
		$user = $clsUser->get_by_id($id);
		return view('backend.users.edit', compact('user', 'u_id'));
	}

	/*
	|-----------------------------------
	| post user edit
	|-----------------------------------
	*/
	public function postEdit($id){
		$clsUser            = new UserModel();
		$Rules = $clsUser->Rules();
		if(empty(Input::get('u_passwd'))){
			unset($Rules['u_passwd']);
		}

		$validator = Validator::make(Input::all(), $Rules, $clsUser->Messages());

		if ($validator->fails()) {
			return redirect()->route('backend.users.edit',$id)->withErrors($validator)->withInput();
		}

		$data['u_name']                 = Input::get('u_name');
		$data['u_login']                = Input::get('u_login');
		if(!empty(Input::get('u_passwd'))){
			$data['u_passwd']           = Hash::make(Input::get('u_passwd'));
		}

		if(!empty(Input::get('u_flag'))){
			$data['u_flag']             = Input::get('u_flag');
		}else{
			$data['u_flag']             = NULL;
		}

		$data['last_ipadrs']            = CLIENT_IP_ADRS;
		$data['last_date']              = date('y-m-d H:i:s');
		$data['last_user']              = Auth::user()->u_id;
		$data['last_kind']              = UPDATE;

		Session::put('edit_user', $data);
		return redirect()->route('backend.users.edit_cnf', $id);
	}

	/*
	|-----------------------------------
	| get user edit confirm
	|-----------------------------------
	*/
	public function editCnf($id){
		$u_id = $id;
		$clsUser               = new UserModel();
		if (Session::has('edit_user')) {
			$user              =  (object) Session::get('edit_user');
			return view('backend.users.edit_cnf', compact('user', 'u_id'));
		}
		return redirect()->route('backend.users.edit', $id);
	}

	/*
	|-----------------------------------
	| save user edit
	|-----------------------------------
	*/
	public function editSave($id){
		$clsUser                = new UserModel();
		if (Session::has('edit_user')) {
			$data               =  (array) Session::get('edit_user');
			if ( $clsUser->update($id, $data) ) {
				Session::forget('edit_user');
				Session::flash('success', trans('common.msg_cts-adm_edit_success'));
				return redirect()->route('backend.users.index');
			} else {
				Session::flash('danger', trans('common.msg_cts-adm_edit_danger'));
				return redirect()->route('backend.users.edit_cnf', $id);
			}
		}else{
			return redirect()->route('backend.users.edit',$id);
		}
	}

	public function editBack($id){
		if (Session::has('user')) {
			$user = Session::get('user');
			unset($user['u_passwd']);
			return redirect()->route('backend.users.edit', $id)->withInput($user);
		}else{
			return redirect()->route('backend.users.edit', $id);
		}
	}

	/*
	|-----------------------------------
	| get user detail
	|-----------------------------------
	*/
	public function detail($id){
		$clsUser                = new UserModel();
		$user = $clsUser->get_by_id($id);
		$u_id = $id;
		return view('backend.users.detail', compact('user', 'u_id'));
	}

	/*
	|-----------------------------------
	| get user delete confirm
	|-----------------------------------
	*/
	public function delete($id){
		$clsUser                = new UserModel();
		$user = $clsUser->get_by_id($id);
		return view('backend.users.delete', compact('user'));
	}

	/*
	|-----------------------------------
	| get user delete save
	|-----------------------------------
	*/
	public function deleteSave($id){
		$clsUser                = new UserModel();
		$data['last_kind']       = DELETE;
        $data['last_date']       = date('Y-m-d H:i:s');
        $data['last_ipadrs']     = CLIENT_IP_ADRS;
        $data['last_user']       = Auth::user()->u_id;
        $clsUser                   = new UserModel();
        if ( $clsUser->update($id, $data) ) {
        	Session::flash('success', trans('common.msg_cts-adm_del_success'));
            return redirect()->route('backend.users.index');
        } else {
        	Session::flash('success', trans('common.msg_cts-adm_del_danger'));
            return redirect()->route('backend.users.detail',$id);
        }
	}

	/*
	|-----------------------------------
	| post logout
	|-----------------------------------
	*/
	public function logout()
	{
		Auth::logout();
		Session::flush();
		return redirect()->route('auth.login');
	}

}