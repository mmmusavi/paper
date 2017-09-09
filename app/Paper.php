<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paper extends Model
{
    protected $guarded=[];
    
    public function volume(){
        return $this->belongsTo('/App/Volume');
    }
}
