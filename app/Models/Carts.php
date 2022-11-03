<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Carts extends Model
{
    // use SoftDeletes;
    
    protected $primaryKey   = 'id';
    protected $table        = 'tbl_cart';
    protected $guarded      = [];


    /**
     * connecting to image eloquent relationship
    */
    public function detailProduk() {
        return $this->hasOne('App\Models\Produk', 'id', 'produk_id')->with(['detailImage']);
    }

}
