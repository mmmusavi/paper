<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Magazine extends Model
{
    public function volume_cats(){
        return $this->hasMany('App\VolumeCat');
    }
}
