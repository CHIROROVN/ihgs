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
	public function postRegist()
    {
        $clsBelong      = new BelongModel();
        $inputs         = Input::all();
        $validator      = Validator::make($inputs, $clsBelong->Rules(), $clsBelong->Messages());
        if ($validator->fails()) {
            return redirect()->route('ortho.belongs.regist')->withErrors($validator)->withInput();
        }
        // insert
        $max = $clsBelong->get_max();
        $dataInsert             = array(
            'belong_name'       => Input::get('belong_name'),
            'belong_sort'       => $max + 1,
            'belong_parent_id'  => '0',
            'belong_code'       => Input::get('belong_code'),
            'last_date'         => date('y-m-d H:i:s'),
            'last_kind'         => INSERT,
            'last_ipadrs'       => CLIENT_IP_ADRS,
            //'last_user'         => Auth::user()->id
            'last_user'         => '1'
        );
        
        if ( $clsBelong->insert($dataInsert) ) {
            Session::flash('success', trans('common.message_regist_success'));
        } else {
            Session::flash('danger', trans('common.message_regist_danger'));
        }
        return redirect()->route('backend.division.index');
    }

    /**
     * 
     */
    public function getEdit($id)
    {
        $clsBelong          = new BelongModel();
        $data['belong']     = $clsBelong->get_by_id($id);
        return view('backend.division.edit', $data);
    }

    /**
     * 
     */
    public function postEdit($id)
    {
        $clsBelong      = new BelongModel();
        $inputs         = Input::all();
        $validator      = Validator::make($inputs, $clsBelong->Rules(), $clsBelong->Messages());
        if ($validator->fails()) {
            return redirect()->route('backend.division.edit', [$id])->withErrors($validator)->withInput();
        }

        // update
        $dataUpdate = array(
            'belong_name'       => Input::get('belong_name'),
            'belong_code'       => Input::get('belong_code'),
            'last_date'         => date('y-m-d H:i:s'),
            'last_kind'         => UPDATE,
            'last_ipadrs'       => $_SERVER['REMOTE_ADDR'],
            'last_user'         => Auth::user()->id
        );

        if ( $clsBelong->update($id, $dataUpdate) ) {
            Session::flash('success', trans('common.message_edit_success'));
        } else {
            Session::flash('danger', trans('common.message_edit_danger'));
        }
        return redirect()->route('backend.division.index');
    }

    /**
     * 
     */
    public function getDelete($id)
    {
        $clsBelong              = new BelongModel();
        $dataUpdate             = array(
            'last_date'         => date('y-m-d H:i:s'),
            'last_kind'         => DELETE,
            'last_ipadrs'       => $_SERVER['REMOTE_ADDR'],
            'last_user'         => Auth::user()->id
        );
        if ( $clsBelong->update($id, $dataUpdate) ) {
            Session::flash('success', trans('common.message_delete_success'));
        } else {
            Session::flash('danger', trans('common.message_delete_danger'));
        }
        return redirect()->route('backend.division.index');
    }

    /**
     * 
     */
    public function orderby_top()
    {
        $clsBelong      = new BelongModel();
        $id             = Input::get('id');
        $this->top($clsBelong, $id, 'belong_sort');
        return redirect()->route('backend.division.index');
    }

    /**
     * 
     */
    public function orderby_last()
    {
        $clsBelong      = new BelongModel();
        $id             = Input::get('id');        
        $this->last($clsBelong, $id, 'belong_sort');
        return redirect()->route('backend.division.index');
    }

    /**
     * 
     */
    public function orderby_up()
    {
        $clsBelong      = new BelongModel();
        $id             = Input::get('id');
        $belongs        = $clsBelong->get_all();
        $this->up($clsBelong, $id, $belongs, 'belong_id', 'belong_sort');
        return redirect()->route('backend.division.index');
    }

    /**
     * 
     */
    public function orderby_down()
    {
        $clsBelong      = new BelongModel();
        $id             = Input::get('id');
        $belongs        = $clsBelong->get_all();
        $this->down($clsBelong, $id, $belongs, 'belong_id', 'belong_sort');
        return redirect()->route('backend.division.index');
    }
}