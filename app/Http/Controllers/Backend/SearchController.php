<?php namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Backend\BackendController;
use App\Http\Models\SearchModel;

use App\Http\Models\DivisionModel;

use Input;
use Validator;
use Session;
use Config;

class SearchController extends BackendController
{
	public static function getDivision($name='belong_name', $selected=1){
		$clsDivision = new DivisionModel();
		return $clsDivision->attr(['name' => $name, 'class'=>'form-control', 'placeholder'=>'部課名'])->selected($selected)->orderBy('belong_sort', 'asc')->renderAsDropdown();
	}


	public function index(){
		$clsSearch = new SearchModel();
		$data = array();
		$where = array();
		$data['worktimes'] = array();
		//$data['divisions'] = $clsBelong->list_division_tree();

		$data['curr_year'] = date('Y');
		$data['curr_month'] = date('m');

		$data['belong_id'] = Input::get('belong_id');
		$data['year_from'] = Input::get('year_from');
		$data['month_from'] = Input::get('month_from');
		$data['year_to'] = Input::get('year_to');
		$data['month_to'] = Input::get('month_to');
		$data['kw'] = Input::get('kw');

		
		//$data['division'] = $clsDivision->nested()->get();

		if(!empty(Input::get('belong_id'))){
			$data['belong_selected'] = Input::get('belong_id');
		}else{
			$data['belong_selected'] = 1;
		}

		if(!empty(Input::get('year_from'))){
			$where['year_from'] = Input::get('year_from');
		}

		if(!empty(Input::get('month_from'))){
			$where['month_from'] = Input::get('month_from');
		}

		if(!empty(Input::get('year_to'))){
			$where['year_to'] = Input::get('year_to');
		}

		if(!empty(Input::get('month_to'))){
			$where['month_to'] = Input::get('month_to');
		}

		if(!empty(Input::get('kw'))){
			$where['kw'] = Input::get('kw');
		}

		if(!empty($where)){
			$data['worktimes'] = $clsSearch->staffOfWorkTime($where);
		}

		return view('backend.search.index', $data);
	}


}