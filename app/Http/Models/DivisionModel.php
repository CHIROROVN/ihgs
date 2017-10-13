<?php namespace App\Http\Models;

use Nestable\NestableTrait;
use Illuminate\Database\Eloquent\Model;

class DivisionModel extends Model{

    use NestableTrait;

    protected $table = 'm_belong';
    protected $primaryKey   = 'belong_id';
    public $timestamps  = false;
    protected $parent = 'belong_parent_id';







}