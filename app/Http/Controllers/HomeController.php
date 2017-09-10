<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $volumes= \App\Volume::all();
        return view('home',compact('volumes'));
    }
    public function ViewVolumePapers ($id){
        $papers=\App\Volume::find($id)->papers;
        return view('volume');
    }
}
