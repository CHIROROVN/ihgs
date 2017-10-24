<?php namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Config;

class BackendController extends Controller
{
    public function __construct(){

        $this->middleware('auth', ['except' => ['postLogin', 'login','logout']]);
        ini_set("memory_limit", "256M");
        //Define contants
        $configs = Config::get('constants.DEFINE');

        foreach($configs as $key => $value)
        {
            define($key, $value);
        }    

        //get IP address from user
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if(isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = '';

        define('CLIENT_IP_ADRS', $ipaddress);
    }
    protected function top($clsObject, $id, $field_sort,$parent_id='')
    {
        $min = $clsObject->get_min($parent_id);
        // update
        $dataUpdate = array(
            $field_sort => $min - 1
        );
        $clsObject->update($id, $dataUpdate);
    }

    protected function last($clsObject, $id, $field_sort,$parent_id='')
    {
        $max = $clsObject->get_max($parent_id);

        // update
        $dataUpdate = array(
            $field_sort => $max + 1
        );
        $clsObject->update($id, $dataUpdate);
    }

    protected function up($clsObject, $id, $array, $field_primary, $field_sort)
    {
        $count = count($array);
        $cur_belong = NULL;
        $up_belong = NULL;
        for($i = 0; $i < $count; $i++)
        {
            
            if($array[$i]->$field_primary == $id)
            {
                $cur_belong = $array[$i];
                $up_belong = $array[$i - 1];
                break;
            }
        }

        // update
        // swap cur->up
        $dataUpdate = array(
            $field_sort => $up_belong->$field_sort
        );
        $clsObject->update($cur_belong->$field_primary, $dataUpdate);

        // swap up->cur
        $dataUpdate = array(
            $field_sort => $cur_belong->$field_sort
        );
        $clsObject->update($up_belong->$field_primary, $dataUpdate);
    }

    protected function down($clsObject, $id, $array, $field_primary, $field_sort)
    {
        $count = count($array);
        $cur_belong = NULL;
        $down_belong = NULL;
        for($i = 0; $i < $count; $i++)
        {
            
            if($array[$i]->$field_primary == $id)
            {
                $cur_belong = $array[$i];
                $down_belong = $array[$i + 1];
                break;
            }
        }

        // update
        // swap cur->down
        $dataUpdate = array(
            $field_sort => $down_belong->$field_sort
        );
        $clsObject->update($cur_belong->$field_primary, $dataUpdate);

        // swap down->cur
        $dataUpdate = array(
            $field_sort => $cur_belong->$field_sort
        );
        $clsObject->update($down_belong->$field_primary, $dataUpdate);
    }
    protected function changeDate($date_source,$date_format,$source_type,$action='')
    {
        $arrData = explode(":", $date_format);
        // echo "<br>source".$date_source;
        //echo "<pre>";print_r($arrData);echo "</pre>";
        if($source_type=='date'){
            $strYear = substr($date_source, $arrData[0], $arrData[1]);           
            $strMonth = substr($date_source, $arrData[2], $arrData[3]);            
            $strDate = substr($date_source, $arrData[4], $arrData[5]);             
            return date("Y-m-d",mktime(0, 0, 0, $strMonth, $strDate, $strYear));
        }elseif($source_type=='fulldate'){            
            $strYear = substr($date_source, $arrData[0], $arrData[1]);                       
            $strMonth = substr($date_source, $arrData[2], $arrData[3]);                        
            $strDate = substr($date_source, $arrData[4], $arrData[5]); 
            $strH = substr($date_source, $arrData[6], $arrData[7]);                  
            $strI = substr($date_source, $arrData[8], $arrData[9]);                      
            $strS = substr($date_source, $arrData[10], $arrData[11]);                   
            return date("Y-m-d h:i:s",mktime((int)$strH, (int)$strI, (int)$strS, (int)$strMonth, (int)$strDate, (int)$strYear));
        }else{    
           $strH = substr($date_source, $arrData[0], $arrData[1]);                                 
           $strI = substr($date_source, $arrData[2], $arrData[3]);                       
           $strS = substr($date_source, $arrData[4], $arrData[5]);                       
           return date("H:i:s",mktime((int)$strH, (int)$strI, (int)$strS, date("m"),  date("d"), date("Y")));
        }
    }
    protected function  readFileCsv($filename)
    {
        $arrResult = array();
        $ary[] = "ASCII";
        $ary[] = "JIS";
        $ary[] = "EUC-JP";
        $ary[] = "Shift-JIS";   
        $ary[] = "eucjp-win"; 
        $ary[] = "sjis-win";
        $ary[] = "UTF-8";    
        $string = file_get_contents($filename);
        if(mb_detect_encoding($string, 'auto') !='UTF-8')           
            $str = mb_convert_encoding($string, "UTF-8", mb_detect_encoding($string, $ary));
        else  $str =  $string; 
        unset($string);
        $convert = explode("\n", $str);
        for ($i=1;$i<count($convert);$i++)  
        {
            $arrTempt = array();            
            $arrTempt = explode(",",$convert[$i]);
            $arrResult[$i-1][0] = '';
            foreach($arrTempt as $value){
                $arrResult[$i-1][] = $value;
            }         
                                               
        }
        unset($convert);
        return $arrResult;
    }   
}