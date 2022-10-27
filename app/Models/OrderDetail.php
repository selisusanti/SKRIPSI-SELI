<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderDetail extends Model
{
    use SoftDeletes;
    
    protected $primaryKey   = 'id';
    protected $table        = 'tbl_order_detail';
    protected $guarded      = [];
}
