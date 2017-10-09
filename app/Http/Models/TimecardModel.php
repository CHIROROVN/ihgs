<?php namespace App\Http\Models;

use DB;
use Hash;
use Auth;
use Validator;

class TimecardModel
{
    protected $table = 'm_timecard';

    public function Rules()
    {
        return array(
            'belong_name' => 'required',
            'belong_code' => 'required',
        );
    }

    public function Messages()
    {
        return array(
            'belong_name.required'  => trans('validation.error_belong_name_required'),
            'belong_code.required'  => trans('validation.error_belong_code_required'),
        );
    }

      

}