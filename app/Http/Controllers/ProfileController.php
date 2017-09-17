<?php

namespace App\Http\Controllers;

use App\Cart;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        return view('profile.index');
    }

    public function account(){
        return view('profile.account');
    }

    public function addtoCart($id){
        $check=\App\Cart::where([['user_id',\Auth::user()->id],['paper_id',$id]])->get();
        if(count($check)==0){
            $cart=new \App\Cart;
            $cart->user_id=\Auth::user()->id;
            $cart->paper_id=$id;
            $cart->save();
            \Session::flash('buy_message','محصول مورد نظر به سبد خرید شما اضافه شد.');
        }else{
            \Session::flash('buy_message','محصول مورد نظر در سبد خرید شما موجود است.');
        }
        return \Redirect::back();
    }
    public function deleteCart($id){
        \App\Cart::destroy($id);
        \Session::flash('buy_message','محصول مورد نظر از سبد خرید شما حذف شد.');
        return \Redirect::back();
    }

    public function checkout(){
        return \Redirect::back();
    }

}
