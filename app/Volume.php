<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Volume extends Model
{
    public function papers(){
        return $this->hasMany('\App\Paper');
    }
}
