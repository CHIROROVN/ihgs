<?php namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Config;

class BackendController extends Controller
{
    public function __construct(){

        $this->middleware('auth', ['except' => ['postLogin', 'login','logout']]);

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
    protected function changeDate($date_source,$date_format,$source_type,$result_type)
    {
        $arrData = explode(":", $date_format); 
        echo "<br>"; print_r($arrData); echo "<br>";
        echo $date_source;echo "<br>";
        if($source_type=='date'){
            $strYear = substr($date_source, $arrData[0], $arrData[1]);
            echo $strYear."<br>";
            $strMonth = substr($date_source, $arrData[2], $arrData[3]);
            echo $strMonth."<br>";
            $strDate = substr($date_source, $arrData[4], $arrData[5]);
             echo $strDate."<br>";
            return date("Y-m-d",mktime(0, 0, 0, $strMonth, $strDate, $strYear));
        }else{
           $strH = substr($date_source, $arrData[0], $arrData[1]);
           echo $strH."<br>";
           $strI = substr($date_source, $arrData[2], $arrData[3]);
           echo $strI."<br>";
           $strS = substr($date_source, $arrData[4], $arrData[5]);
           echo $strS."<br>";
           return date("h:i:s",mktime($strH, $strI, $strS, date("m"),  date("d"), date("Y")));
        }
    }
}