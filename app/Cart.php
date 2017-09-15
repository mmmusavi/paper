<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table='carts';
    public function paper(){
        return $this->belongsTo('App\Paper');
    }
}
