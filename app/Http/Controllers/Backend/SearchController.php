<?php namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Backend\BackendController;
use App\Http\Models\BelongModel;
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

		$data['u_belong'] = Input::get('u_belong');
		$data['year_from'] = Input::get('year_from');
		$data['month_from'] = Input::get('month_from');
		$data['year_to'] = Input::get('year_to');
		$data['month_to'] = Input::get('month_to');
		$data['words'] = Input::get('words');

		return view('backend.search.index', $data);
	}
}