<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produk extends Model
{
    use SoftDeletes;
    
    protected $primaryKey   = 'id';
    protected $table        = 'tbl_produk';
    protected $guarded      = [];


    /**
     * connecting to image eloquent relationship
    */
    public function detailImage() {
        return $this->hasMany('App\Models\Detailproduk', 'id_produk', 'id');
    }

}
