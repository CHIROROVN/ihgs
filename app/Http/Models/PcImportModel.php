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
            'tp_dataname'               => 'required|unique:t_pc,tp_dataname',
            'tp_file_csv'               => 'required|mimes:csv,xls,xlsx',
        );
    }

    public function Messages()
    {
        return array(
            'tp_dataname.required'      => trans('validation.error_tp_dataname_required'),
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
        $results = DB::table($this->table)->select('tp_dataname', 'last_date')->distinct('tp_dataname')->get();
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
        if(!empty($staff)){
            $sql = DB::table('t_pc')
                ->select(DB::raw("min(tp_actiontime) as action_in, max(tp_actiontime) as action_out"))
                ->whereDate('tp_actiontime', $date);

            if(!empty($staff->staff_pc1)){
                $sql = $sql->whereNotNull('tp_pc_no')
                ->where('tp_pc_no', $staff->staff_pc1);
            }
            if(!empty($staff->staff_pc2)){
                $sql = $sql->whereNotNull('tp_pc_no')
                ->where('tp_pc_no', $staff->staff_pc2);
            }
            if(!empty($staff->staff_pc31)){
                $sql = $sql->whereNotNull('tp_pc_no')
                ->where('tp_pc_no', $staff->staff_pc3);
            }
            if(!empty($staff->staff_pc4)){
                $sql = $sql->whereNotNull('tp_pc_no')
                ->where('tp_pc_no', $staff->staff_pc4);
            }
            if(!empty($staff->staff_pc5)){
                $sql = $sql->whereNotNull('tp_pc_no')
                ->where('tp_pc_no', $staff->staff_pc5);
            }
            if(!empty($staff->staff_pc6)){
                $sql = $sql->whereNotNull('tp_pc_no')
                ->where('tp_pc_no', $staff->staff_pc6);
            }
            if(!empty($staff->staff_pc7)){
                $sql = $sql->whereNotNull('tp_pc_no')
                ->where('tp_pc_no', $staff->staff_pc7);
            }
            if(!empty($staff->staff_pc8)){
                $sql = $sql->whereNotNull('tp_pc_no')
                ->where('tp_pc_no', $staff->staff_pc8);
            }
            if(!empty($staff->staff_pc9)){
                $sql = $sql->whereNotNull('tp_pc_no')
                ->where('tp_pc_no', $staff->staff_pc9);
            }
            if(!empty($staff->staff_pc10)){
                $sql = $sql->whereNotNull('tp_pc_no')
                ->where('tp_pc_no', $staff->staff_pc10);
            }

            return $sql->get();
        }

    }

}