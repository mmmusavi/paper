<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paper extends Model
{
    protected $guarded=[];

    public function volume(){
        return $this->belongsTo('App\Volume');
    }

    public function magazine(){
        return $this->belongsTo('App\Magazine');
    }

    public function users(){
        return $this->belongsToMany('App\User')->withPivot('affiliation_id')->withPivot('email');
    }

    public function affiliations(){
        return $this->belongsToMany('App\Affiliation','paper_user');
    }

    public function authors(){
        return $this->hasMany('App\PaperUser');
    }

    public function keywords(){
        return $this->belongsToMany('App\Keyword','paper_keyword');
    }

    public function figures(){
        return $this->hasMany('App\Figure');
    }
    public function references(){
        return $this->hasMany('App\Reference');
    }
}
