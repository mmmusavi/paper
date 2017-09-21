<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function show()
    {
        return view('login');
    }
    public function checkUser(Request $request){
        $email=$request['email'];
        $pass=$request['password'];
        if(Auth::attempt(['email'=>$email,'password'=>$pass])){
            return redirect('/');
        }
        else{
            $errors='اطلاعات وارد شده نادرست است.';
            return view('login',compact('errors'));
        }
    }
}
