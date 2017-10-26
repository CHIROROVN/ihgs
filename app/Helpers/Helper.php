<?php
use Carbon\Carbon;

$number = cal_days_in_month(CAL_GREGORIAN, 8, 2003);

if (!function_exists('dayOfMonth')) {
	function dayOfMonth($year, $month)
	{
		return $number = cal_days_in_month(CAL_GREGORIAN, $month, $year);
    }
}

if (!function_exists('division')) {
	function division($belong_id=null)
	{
		$division = App\Http\Models\BelongModel::get_division_by_id($belong_id);
		if(!empty($division)){
	        return $division->belong_name;
	    }else{
	    	return '';
	    }
    }
}

if (!function_exists('show_overtime')) {
	function show_overtime($time)
	{
		return !empty($time) ? $time : 'データ無し';
    }
}

if (!function_exists('search_work_time')) {
	function search_work_time($staff_id_no, $conditions)
	{
		return App\Http\Models\SearchModel::staffOfWorkTime($staff_id_no, $conditions);		
    }
}

if (!function_exists('touchtime')) {
	function touchtime($staff, $date)
	{
		return App\Http\Models\DoorcardImportModel::touchtime($staff, $date);		
    }
}

if (!function_exists('actiontime')) {
	function actiontime($staff, $date)
	{
		return App\Http\Models\PcImportModel::actiontime($staff, $date);		
    }
}

if (!function_exists('divisions')) {
	function divisions($name, $selected, $flag)
	{
		$dropdown = App\Http\Controllers\Backend\SearchController::getDivision($name, $selected, $flag);

		return $dropdown;
    }
}

if (!function_exists('format_date')) {

	/**
	 * description
	 *
	 * @param
	 * @return
	 */
	function format_date($date, $comm='/')
	{
		if(!empty($date)){
			return date('Y'.$comm.'m'.$comm.'d', strtotime($date));
		}else{
			return '';
		}
	}
}

if (!function_exists('file_exists')) {

	/**
	 * description
	 *
	 * @param
	 * @return
	 */
	function file_exists($file)
	{
		return file_exists($file);
	}
}

if (!function_exists('format_date')) {

	/**
	 * description
	 *
	 * @param
	 * @return
	 */
	function format_date($date, $comm='/')
	{
		if(!empty($date)){
			return date('Y'.$comm.'m'.$comm.'d', strtotime($date));
		}else{
			return '';
		}
	}
}

if (!function_exists('date_time')) {

	/**
	 * description
	 *
	 * @param
	 * @return
	 */
	function date_time($date, $comm='/')
	{
		if(!empty($date)){
			return date('Y'.$comm.'m'.$comm.'d'.' '. 'H:i:s', strtotime($date));
		}else{
			return '';
		}
	}
}

if (!function_exists('split_date')) {

	/**
	 * description
	 *
	 * @param
	 * @return
	 */
	function split_date($date, $param)
	{
		if(!empty($date)){
			switch ($param) {
				case 'Y':
					return date('Y', strtotime($date));
					break;
				case 'm':
					return date('m', strtotime($date));
					break;
				case 'd':
					return date('d', strtotime($date));
					break;
				case 'H':
					return date('H', strtotime($date));
					break;
				case 'i':
					return date('i', strtotime($date));
					break;
				case 's':
					return date('s', strtotime($date));
					break;
				default:
					return $date;
					break;
			}
		}else{
			return '';
		}
	}
}

if (!function_exists('c2digit')) {
	/**
	 * description
	 *
	 * @param
	 * @return
	 */
	function c2digit($num)
	{
		if(!empty($num)){
			//return sprintf("%02d", $num);
			return str_pad($num, 2,'0',STR_PAD_LEFT);
		}else{
			return $num;
		}
	}
}

if (!function_exists('dateJp')) {
	/**
	 * description
	 *
	 * @param
	 * @return
	 */
	function dateJp($date)
	{
		if(!empty($date)){
			$year = date('Y', strtotime($date));
			$month = (int) date('m', strtotime($date)) + 0;
			$day = (int) date('d', strtotime($date)) + 0;
			$hour = (int) date('H', strtotime($date)) + 0;
			$minute = (int) date('i', strtotime($date)) + 0;
		   return $year .'年' . $month . '月' . $day . '日' . '  ' . $hour .'時' . $minute . '分';
		}else{
			return '';
		}
	}
}

if (!function_exists('japan_date')) {
	/**
	 * description
	 *
	 * @param
	 * @return
	 */
	function japan_date($date)
	{
		if(!empty($date)){
			$year = date('Y', strtotime($date));
			$month = (int) date('m', strtotime($date)) + 0;
			$day = (int) date('d', strtotime($date)) + 0;
		   return $year .'年' . $month . '月' . $day . '日';
		}else{
			return '';
		}
	}
}


if (!function_exists('DayJp')) {

	/**
	 * description
	 *
	 * @param
	 * @return
	 */
	function DayJp($date=null){
		if(!empty($date)){
			$convertEn2Jp = array('Sun'=>'日', 'Mon'=>'月', 'Tue'=>'火', 'Wed'=>'水', 'Thu'=>'木', 'Fri'=>'金', 'Sat'=>'土');
			$month = (int) date('m', strtotime($date)) + 0;
			$day = (int) date('d', strtotime($date)) + 0;
			$dayEn = strtotime($date);
			return $month . '月' . $day . '日' . ' ('.$convertEn2Jp[date("D", $dayEn)].')';
		}else{
			return null;
		}
	}
}

if (!function_exists('DayeJp')) {

	/**
	 * description
	 *
	 * @param
	 * @return
	 */
	function DayeJp($date=null){
		if(!empty($date)){
			$convertEn2Jp = array('Sun'=>'日', 'Mon'=>'月', 'Tue'=>'火', 'Wed'=>'水', 'Thu'=>'木', 'Fri'=>'金', 'Sat'=>'土');
			$month = (int) date('m', strtotime($date)) + 0;
			$year = (int) date('Y', strtotime($date)) + 0;
			$day = (int) date('d', strtotime($date)) + 0;
			$dayEn = strtotime($date);
			return $year.'/'.$month . '/' . $day  . ' ('.$convertEn2Jp[date("D", $dayEn)].')';
		}else{
			return null;
		}
	}
}

if (!function_exists('DateDayJp')) {

	/**
	 * description
	 *
	 * @param
	 * @return
	 */
	function DateDayJp($date=null){
		if(!empty($date)){
			$convertEn2Jp = array('Sun'=>'日', 'Mon'=>'月', 'Tue'=>'火', 'Wed'=>'水', 'Thu'=>'木', 'Fri'=>'金', 'Sat'=>'土');
			$month = (int) date('m', strtotime($date)) + 0;
			$year = (int) date('Y', strtotime($date)) + 0;
			$day = (int) date('d', strtotime($date)) + 0;
			$dayEn = strtotime($date);
			return $year.'年'.$month . '月' . $day . '日' . '('.$convertEn2Jp[date("D", $dayEn)].')';
		}else{
			return null;
		}
	}
}

if (!function_exists('formatshortTime')) {
	function formatshortTime($time=null, $chars=':'){
		if(!empty($time)){
			$arrData = explode($chars, $time);
			return $arrData[0].':'.$arrData[1];
		}else{
			return null;
		}	
	}	
}	

if (!function_exists('neatest_trim')) {

	/**
	 * description
	 *
	 * @param
	 * @return
	 */
	function neatest_trim($content, $chars) {
	  if (mb_strlen($content,'UTF-8') > $chars) 
	  {
	    $content = str_replace('&nbsp;', ' ', $content);
	    $content = str_replace("\n", '', $content);
	    $content = strip_tags($content);
	    $content = preg_replace('/\s+?(\S+)?$/', '', mb_substr($content, 0, $chars));

	    $content = trim($content) . '・・・';
	    return $content;
	  }else {
	      return $content;
	  }

	}
}

if (!function_exists('hour_minute')) {
	function hour_minute($date=null){
		if(!empty($date)){
			return date('H:i', strtotime($date));
		}else{
			return null;
		}	
	}	
}

if (!function_exists('time_over')) {
	function time_over($start=null, $end=null){
		$overtime = $start + $end;
		$mins = $overtime / 60;
		if( ($mins > 30) && ($mins <= 60) ){
			return '30分超';	
		}elseif( $mins > 60 ){
			return '1時間超';
		}else{
			return '';
		}
	}	
}

// if (!function_exists('time_over2')) {
// 	function time_over2($start=null, $end=null){
// 		$result = '';
// 		$seconds = $start + $end;
// 		$time = gmdate('H:i:s', $seconds);
// 		$arrTime = explode(':', $time);
// 		$mins = $seconds / 60;
// 		$H = $arrTime[0] + 0;
// 		$i = $arrTime[1] + 0;
// 		if( $mins >= 31 ){
// 			if($H > 0){
// 				$result .= $H.'時';
// 			}
// 			if($i > 0){
// 				$result .= $i.'分';
// 			}
// 			if( ($H > 0 && $i > 0) || ($H > 0 && $i == 0) ) $result .= '間';
// 			return $result.'超';	
// 		}else{
// 			return '';
// 		}
// 	}	
// }

if (!function_exists('compare_min')) {
	/**
	 * description
	 *
	 * @param
	 * @return
	 */
	function compare_min($time1=null, $time2=null)
	{
		if(strtotime($time1) <= strtotime($time2)){
			return $time1;
		}else{
			return $time2;
		}
	}
}

if (!function_exists('compare_max')) {
	/**
	 * description
	 *
	 * @param
	 * @return
	 */
	function compare_max($time1=null, $time2=null)
	{
		if(strtotime($time1) >= strtotime($time2)){
			return $time1;
		}else{
			return $time2;
		}
	}
}

if (!function_exists('time2second')) {
	function time2second($time){
		if(!empty($time)){
			$timeArr = array_reverse(explode(":", $time));
			$seconds = 0;
			foreach ($timeArr as $key => $value)
			{
			    if ($key > 2) break;
			    $seconds += pow(60, $key) * $value;
			}
			return $seconds;
		}else{
			return '';
		}
	}
}

if (!function_exists('over_in')) {
	function over_in($time1, $time2){
		return $time1 - $time2;
		// if($result >= 0){
		// 	return $result;
		// }else{
		// 	return 0;
		// }
	}
}

if (!function_exists('over_out')) {
	function over_out($time1, $time2){
		return $time2 - $time1;
		// if($result >= 0){
		// 	return $result;
		// }else{
		// 	return 0;
		// }
	}
}
if (!function_exists('get_time_diff')) {
	/**
	 * description
	 *
	 * @param
	 * @return
	 */
	function get_time_diff($time_door,$time_pc,$time_card)
	{		
		$temptDoor     = isset($time_door)?strtotime($time_door):0;
		$temptPC       = isset($time_pc)?strtotime($time_pc):0;
		$tempt         = isset($time_card)?strtotime($time_card):0;
		if($temptDoor==0 && $temptPC==0)
			return 0;
		elseif($temptDoor==0){
			return ($tempt >$temptPC)?$tempt-$temptPC:$temptPC-$tempt;
		}elseif($temptPC==0)
		   return ($tempt >$temptDoor)?$tempt-$temptDoor:$temptDoor-$tempt;
	}
}


if (!function_exists('style_overtime')) {
	/**
	 * description
	 *
	 * @param
	 * @return
	 */
	function style_overtime($start=null, $end=null)
	{
		$overtime = ($start + $end)/60;
		if(($overtime > 30) && ($overtime <= 60)){
			return 'class=bg-yellow';
		}elseif($overtime > 60){
			return 'class=bg-red';
		}else{
			return '';
		}
	}
}

if (!function_exists('style_overwork')) {
	/**
	 * description
	 *
	 * @param
	 * @return
	 */
	function style_overwork($worktime)
	{		
		if($worktime >59)
			return 'class="bg-red"';
		else
			return '';		
	}
}
