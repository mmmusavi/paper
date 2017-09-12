<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Keyword extends Model
{
    protected $guarded=[];
    public function papers(){
        return $this->belongsToMany('App\Paper','paper_keyword');
    }
}
