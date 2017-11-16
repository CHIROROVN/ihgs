<?php namespace App\Http\Models;

use DB;
use Validator;

class PcImportModel
{
    protected $table   = 't_pc';
    protected $primaryKey   = 'tp_id';
    public $timestamps  = false;

    public function Rules()
    {
        return array(
            'tp_dataname'               => 'required|unique:t_pc,tp_dataname|regex:/^[^\\p{Zs}]+$/u',
            'tp_file_csv'               => 'required|mimes:csv,xls,xlsx',
        );
    }

    public function Messages()
    {
        return array(
            'tp_dataname.required'      => trans('validation.error_tp_dataname_required'),
            'tp_dataname.regex'         => trans('validation.error_tp_dataname_required'),
            'tp_dataname.unique'        => trans('validation.error_tp_dataname_unique'),
            'tp_file_csv.required'      => trans('validation.error_tp_file_csv_required'),
            'tp_file_csv.mimes'         => trans('validation.error_tp_file_csv_mimes'),
        );
    }

   
   //Manage Pc format
    public function getPc(){
        return DB::table($this->table)->get();
    }

    public function get_all_by_dataname()
    {        
        $results = DB::table($this->table)
               ->select(DB::raw('tp_dataname, max(last_date) as last_date'))
               ->groupBy('tp_dataname')              
               ->get(); 
        return $results;
    }

    //pc insert
    public function insert($data)
    {
        return DB::table($this->table)->insert($data);
    }

    //pc update
    public function update($id, $data)
    {
        return DB::table($this->table)->where('tp_id', $id)->update($data);
    }

    //pc delete by tp_dataname
    public function delete($tp_dataname)
    {
        return DB::table($this->table)->where('tp_dataname', $tp_dataname)->delete();
    }

    public static function actiontime($staff=array(), $date=null){
        $sql = DB::table('t_pc')
            ->select(DB::raw('min(tp_logintime) as action_in, max(tp_logouttime) as action_out'))
            ->whereDate('tp_date', $date);

        if(!empty($staff->staff_id_no)){
            $sql = $sql->where('tp_staff_id_no', $staff->staff_id_no);
        }

        return $sql->first();

    }

}