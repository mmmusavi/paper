<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VolumeCat extends Model
{
    protected $table='volume_cat';
    public function volumes(){
        return $this->hasMany('App\Volume','cat');
    }
    public function magazine(){
        return $this->belongsTo('App\Magazine');
    }
}
