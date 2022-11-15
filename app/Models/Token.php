<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Token extends Model
{
    // use SoftDeletes;
    
    protected $primaryKey   = 'id';
    protected $table        = 'tbl_token';
    protected $guarded      = [];


    /**
     * connecting to image eloquent relationship
    */
    public function user() {
        return $this->hasOne('App\User', 'id', 'id_user');
    }

}
