<?php namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Backend\BackendController;
use App\Http\Models\SearchModel;
use App\Http\Models\StaffModel;
use App\Http\Models\BelongModel;
use App\Http\Models\DivisionModel;

use Input;
use Validator;
use Session;
use Config;
use App;
use PDF;

class SearchController extends BackendController
{
	public static function getDivision($name='belong_name', $selected=0, $flag=false){
		$clsDivision = new DivisionModel();
		return $clsDivision->attr(['name' => $name, 'class'=>'form-control', 'placeholder'=>'部課名','flag'=>$flag])->selected($selected)->orderBy('belong_sort', 'asc')->renderAsDropdown();
	}

	public function index(){
		$clsSearch = new SearchModel();
		$clsStaff = new StaffModel();
		$clsBelong = new BelongModel();

		$data = array();
		$where = array();
		$data['staffs'] = array();

		$data['curr_year'] = date('Y');
		$data['curr_month'] = date('m');

		$data['belong_id'] = Input::get('belong_id');
		$data['year_from'] = !empty(Input::get('year_from')) ? Input::get('year_from') : date('Y');
		$data['month_from'] = !empty(Input::get('month_from')) ? Input::get('month_from') : date('m');
		$data['year_to'] = !empty(Input::get('year_to')) ? Input::get('year_to') : date('Y');
		$data['month_to'] = !empty(Input::get('month_to')) ? Input::get('month_to') : date('m')+1;
		$data['kw'] = Input::get('kw');

		$belong_parent_id = array();
		
		if(!empty(Input::get('belong_id'))){
			$data['belong_selected'] = Input::get('belong_id');			
			$where['belong_parent_id'] = $clsBelong->get_list_by_id(Input::get('belong_id'));
		}else{
			$data['belong_selected'] = 0;
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

		$data['conditions'] = $where;

		if(!empty(Input::get('kw'))){
			$where['kw'] = trim(Input::get('kw'));
		}

		if(!empty($where)){
			$data['staffs'] = $clsStaff->search_staff($where);
		}

		return view('backend.search.index', $data);
	}

	public function export_pdf(){
		$clsStaff = new StaffModel();
		$where = array();
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

		$data['conditions'] = $where;
		
		$data['staff'] = $clsStaff->get_by_id(Input::get('staff_id'));

	//return view('backend.search.index_pdf', $data);

		$pdf = PDF::loadView('backend.search.index_pdf', $data);

		return $pdf->download(mb_convert_encoding($data['staff']->staff_name, 'UTF-8') . '_' . rand('9999',time()).'.pdf');
	}


}