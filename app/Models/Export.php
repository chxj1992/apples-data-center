<?php namespace Chxj1992\ApplesDataCenter\App\Models;

use Illuminate\Database\Eloquent\Model;

class Export extends Model
{
    public $timestamps = false;

    public $table = 'export';

    protected $fillable = array('project', 'name', 'path');

}