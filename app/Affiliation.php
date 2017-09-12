<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Affiliation extends Model
{
    protected $guarded=[];
    public function papers(){
        return $this->hasMany('App\PaperUser');
    }
}
