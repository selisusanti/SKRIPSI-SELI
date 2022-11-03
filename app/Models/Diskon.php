<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Diskon extends Model
{
    use SoftDeletes;
    
    protected $primaryKey   = 'id';
    protected $table        = 'tbl_diskon';
    protected $guarded      = [];


}
