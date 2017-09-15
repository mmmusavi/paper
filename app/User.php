<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name','last_name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role(){
        return $this->belongsToMany('App\Role');
    }

    public function papers(){
        return $this->belongsToMany('App\Paper');
    }

    public function cart(){
        return $this->hasMany('App\Cart');
    }

    public function isadmin(){
        $user=\Auth::user();
        $foundAdmin=0;
        foreach($user->role as $role){
            if($role->name=='admin')$foundAdmin=1;
        }
        if($foundAdmin==1)
            return true;
        else
            return false;
    }
}
