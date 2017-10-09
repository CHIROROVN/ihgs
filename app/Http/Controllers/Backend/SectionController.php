<?php namespace App\Http\Controllers\Backend;
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

class SectionController extends BackendController
{
	public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
    }
    /* */
	public function index($parent_id){		
		$data =array();
		$clsBelong          = new BelongModel();
        $data['belongs']    = $clsBelong->get_all_section($parent_id);         
        $data['parent']     = $clsBelong->get_by_id($parent_id);        
        /*if ( $clsBelong->insert($dataInsert) ) {
            Session::flash('danger', trans('common.msg_permission_no_access'));
            return redirect()->route('backend.division.index');
        } */
		return view('backend.section.index',$data);
	}
    /* */
	public function getRegist($parent_id){
		$clsBelong          = new BelongModel();
		$data['parent']     = $clsBelong->get_by_id($parent_id);  
		return view('backend.section.regist',$data);
	}
    /* */
	public function postRegist($parent_id)
    {
        $clsBelong      = new BelongModel();
        $inputs         = Input::all();
        $validator      = Validator::make($inputs, $clsBelong->Rules(), $clsBelong->Messages());
        if ($validator->fails()) {
            return redirect()->route('backend.section.regist')->withErrors($validator)->withInput();
        }
        // insert
        $max = $clsBelong->get_max($parent_id);
        $dataInsert             = array(
            'belong_name'       => Input::get('belong_name'),
            'belong_sort'       => $max + 1,
            'belong_parent_id'  => $parent_id,
            'belong_code'       => Input::get('belong_code'),
            'last_date'         => date('Y-m-d H:i:s'),
            'last_kind'         => INSERT,
            'last_ipadrs'       => CLIENT_IP_ADRS,
            'last_user'         => Auth::user()->u_id            
        );
        
        if ( $clsBelong->insert($dataInsert) ) {
            Session::flash('success', trans('common.msg_regist_success'));
        } else {
            Session::flash('danger', trans('common.msg_regist_danger'));
        }        
        return redirect()->route('backend.section.index', [ $parent_id ]);
    }
     /**
     * 
     */
    public function getEdit($parent_id,$id)
    {
        $clsBelong          = new BelongModel();
        $data['belong']     = $clsBelong->get_by_id($id);
        return view('backend.section.edit', $data);
    }

    /**
     * 
     */
    public function postEdit($parent_id,$id)
    {
        $clsBelong      = new BelongModel();
        $inputs         = Input::all();
        $validator      = Validator::make($inputs, $clsBelong->Rules(), $clsBelong->Messages());
        if ($validator->fails()) {
            return redirect()->route('backend.section.edit', [$id])->withErrors($validator)->withInput();
        }

        // update
        $dataUpdate = array(
            'belong_name'       => Input::get('belong_name'),
            'belong_code'       => Input::get('belong_code'),
            'last_date'         => date('Y-m-d H:i:s'),
            'last_kind'         => UPDATE,
            'last_ipadrs'       => $_SERVER['REMOTE_ADDR'],
            'last_user'         => Auth::user()->u_id 
        );

        if ( $clsBelong->update($id, $dataUpdate) ) {
            Session::flash('success', trans('common.msg_edit_success'));
        } else {
            Session::flash('danger', trans('common.msg_edit_danger'));
        }
        return redirect()->route('backend.section.index', [ $parent_id ]);
    }

    /**
     * 
     */
    public function getDelete($parent_id,$id)
    {
        $clsBelong              = new BelongModel();
        $dataUpdate             = array(
            'last_date'         => date('Y-m-d H:i:s'),
            'last_kind'         => DELETE,
            'last_ipadrs'       => $_SERVER['REMOTE_ADDR'],
            'last_user'         => Auth::user()->u_id 
        );
        if ( $clsBelong->delete($id, $dataUpdate) ) {
            Session::flash('success', trans('common.msg_delete_success'));
        } else {
            Session::flash('danger', trans('common.msg_delete_danger'));
        }
        return redirect()->route('backend.section.index', [ $parent_id ]);
    }

    /**
     * 
     */
    public function orderby_top($parent_id)
    {
        $clsBelong      = new BelongModel();
        $id             = Input::get('id');
        $this->top($clsBelong, $id, 'belong_sort');
        return redirect()->route('backend.section.index', [ $parent_id ]);
    }

    /**
     * 
     */
    public function orderby_last($parent_id)
    {
        $clsBelong      = new BelongModel();
        $id             = Input::get('id');        
        $this->last($clsBelong, $id, 'belong_sort');
        return redirect()->route('backend.section.index', [ $parent_id ]);
    }

    /**
     * 
     */
    public function orderby_up($parent_id)
    {
        $clsBelong      = new BelongModel();
        $id             = Input::get('id');
        $belongs        = $clsBelong->get_all();
        $this->up($clsBelong, $id, $belongs, 'belong_id', 'belong_sort');
        return redirect()->route('backend.section.index', [ $parent_id ]);
    }

    /**
     * 
     */
    public function orderby_down($parent_id)
    {
        $clsBelong      = new BelongModel();
        $id             = Input::get('id');
        $belongs        = $clsBelong->get_all();
        $this->down($clsBelong, $id, $belongs, 'belong_id', 'belong_sort');
        return redirect()->route('backend.section.index', [ $parent_id ]);
    }
}