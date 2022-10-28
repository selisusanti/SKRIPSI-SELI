<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DetailProduk extends Model
{
    use SoftDeletes;
    
    protected $primaryKey   = 'id';
    protected $table        = 'tbl_produk_detail';
    protected $guarded      = [];

    
}
