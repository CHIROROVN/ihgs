<?php
use Carbon\Carbon;

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
		return App\Http\Controllers\Backend\SearchController::getDivision($name, $selected, $flag);
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
		if(!empty($start)){
			$overtime = $start + $end;
			$mins = $overtime / 60;
			if( ($mins > 30) && ($mins <= 60) ){
				return '30分超';	
			}elseif( $mins > 60 ){
				return '1時間超';
			}else{
				return '';
			}
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
		if(!empty($time1) && empty($time1)){
			return $time1;
		}elseif(empty($time1) && !empty($time1)){
			return $time2;
		}
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
		if(!empty($time1) && empty($time1)){
			return $time1;
		}elseif(empty($time1) && !empty($time1)){
			return $time2;
		}
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
	}
}

if (!function_exists('over_out')) {
	function over_out($time1, $time2){
		return $time2 - $time1;
	}
}
if (!function_exists('get_time_diff')) {
	function get_time_diff($time_door,$time_pc,$time_card,$type_time)
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
		else{
             if($type_time=='in') return ($temptDoor < $temptPC)?(($temptDoor < $tempt)?$tempt-$temptDoor:$temptDoor-$tempt):(($temptPC < $tempt)?$tempt-$temptPC:$temptPC-$tempt);
             else  return ($temptDoor < $temptPC)?(($temptPC < $tempt)?$tempt-$temptPC:$temptPC-$tempt):(($temptDoor < $tempt)?$tempt-$temptDoor:$temptDoor-$tempt);
		}    
	}
}
if (!function_exists('get_work_overtime')) {
	function get_work_overtime($time_in,$time_out,$date_overtime)
	{		
		if(empty($time_in) && empty($time_out)) return '';
		$over_time_in =0;$over_time_out=0;
		if(!empty($time_in)){
		   //$arrT          = explode(":",RESET_TIME);$arrMonth = array();
		   $intStartTime  = (isset($arrT[0]) &&  $arrT[0] >24)?$arrT[0]-24:0;	
           $temptIn       = strtotime($date_overtime.' '.$time_in);
           //$reset_time    = isset($intStartTime)?strtotime($date_overtime.' '.$intStartTime.':00:00'):0;
		   $start_time    = strtotime($date_overtime.' '.START_TIME);
		   //$over_time_in  = ($temptIn > $start_time )?0:(($temptIn < $reset_time)?$start_time - $reset_time:$start_time - $temptIn);
		   $over_time_in  = ($temptIn > $start_time )?0:$start_time - $temptIn;
		}
		if(!empty($time_out))
		{
			$end_time       = strtotime($date_overtime.' '.END_TIME);
			$temptOut       = strtotime($date_overtime.' '.$time_out);
			$over_time_out  = ($end_time > $temptOut)?0:$temptOut-$end_time ;
		}	
		$over_time = $over_time_in + $over_time_out;		
		if($over_time <3600) return '';
		$over_time_hours = floor($over_time/3600);
		$over_time_mintue = floor(($over_time%3600)/60);		
		return $over_time_hours.' h'.(($over_time_mintue >0)?$over_time_mintue:'');		
	}
}


if (!function_exists('style_overtime')) {
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
	function style_overwork($worktime,$year=null)
	{
        
        if($year){
			$intTotal =0;						
			foreach($worktime as $value){
           			$intTotal +=$value;
      		}      		
			return ((int)$intTotal > (3600 * MAX_OVERTIME_YEAR))?'class=bg-red':'';		
        }
		else{
			return ((int)$worktime > (3600 * MAX_OVERTIME_MONTH))?'class=bg-red':'';	
				
		}
	}
}
if (!function_exists('display_overwork')) {
	function display_overwork($worktime)
	{	  
       if((int)$worktime ==0) return '0h';
       if((int)$worktime <3600)    return $worktime;
       $over_time_hours = floor($worktime/3600);
	   $over_time_mintue = round(($worktime- ($over_time_hours*3600))/60);	
       return $over_time_hours.' h '.(($over_time_mintue >0)?$over_time_mintue:'');	    	
	}
}
if (!function_exists('display_overwork_staff')) {
	function display_overwork_staff($arrWorktime)
	{	  
      if(is_array($arrWorktime) && count($arrWorktime) >0){
      	$intTotal = 0;
      	foreach($arrWorktime as $value){
           $intTotal +=$value;
      	}
        return display_overwork($intTotal); 
      }else return '';
	}
}
if (!function_exists('count_overwork_staff')) {
	function count_overwork_staff($arrWorktime)
	{	  
      if(is_array($arrWorktime) && count($arrWorktime) >0){
        $intCount =0;
        foreach($arrWorktime as $value){
           if($value > (3600 * MAX_OVERTIME_MONTH))  $intCount++;
      	} 
      	return ($intCount >0)?$intCount.' 回':'';
      }else return '';
	}
}
if (!function_exists('getDatesFromRange')) {
	function getDatesFromRange($start, $end, $format = 'Y-m-d') {
	    $array = array();
	    $interval = new DateInterval('P1D');

	    $realEnd = new DateTime($end);
	    $realEnd->add($interval);

	    $period = new DatePeriod(new DateTime($start), $interval, $realEnd);

	    foreach($period as $date) { 
	        $array[] = $date->format($format); 
	    }

	    return $array;
	}
}
