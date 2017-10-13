<?php namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Backend\BackendController;
use App\Http\Models\BelongModel;

use App\Http\Models\DivisionModel;

use Input;
use Validator;
use Session;
use Config;

class SearchController extends BackendController
{
	public function index(){
		$data = array();
		$clsBelong = new BelongModel();
		$data['divisions'] = $clsBelong->list_division_tree();

		$data['curr_year'] = date('Y');
		$data['curr_month'] = date('m');

		$data['belong_name'] = Input::get('belong_name');
		$data['year_from'] = Input::get('year_from');
		$data['month_from'] = Input::get('month_from');
		$data['year_to'] = Input::get('year_to');
		$data['month_to'] = Input::get('month_to');
		$data['words'] = Input::get('words');

		$clsDivision = new DivisionModel();
		//$data['division'] = $clsDivision->nested()->get();

		if(!empty(Input::get('belong_name'))){
			$data['belong_selected'] = Input::get('belong_name');
		}else{
			$data['belong_selected'] = 1;
		}

		return view('backend.search.index', $data);
	}

	public static function getDivision($name='belong_name', $selected=1){
		$clsDivision = new DivisionModel();
		return $clsDivision->attr(['name' => $name, 'class'=>'form-control', 'placeholder'=>'部課名'])->selected($selected)->orderBy('belong_sort', 'asc')->renderAsDropdown();
	}
}