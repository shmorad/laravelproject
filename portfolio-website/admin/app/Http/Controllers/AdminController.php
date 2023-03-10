<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdminModel;
class AdminController extends Controller
{
    public function logInIndex(){
        return view('loginPage');
    }
    public function onLogOut(Request $request){
        $request->session()->flush();
        return redirect('Login');
    }
    public function onLogin(Request $request){
      $user= $request->input('user');
      $pass= $request->input('pass');
      $countValue=AdminModel::where('username','=',$user)->where('password','=',$pass)->count();
      if($countValue==true){
        $request->session()->put('user',$user);
        return 1;
      }else{
        return 0;
      }
    }
}
