<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Middleware\UserCheck;
use Session;
use DB;

class UserProfile extends Controller
{
    public function show(Request $request, UserCheck $isLogin){
        $hasError = false;
        $errorTitle = '';
        if($request->hasError){
            $hasError = true;
            $errorTitle = 'Login Error!!!';
        }
        if($request->isLogin){
            $user = $request->user;
            if($request->isAdmin){
                return view('home', ['user'=>$user,'user_login'=>false,'admin_login'=>true, 'hasError'=>$hasError, 'errorTitle'=>$errorTitle]);
            } else {
                return view('home', ['user'=>$user,'user_login'=>true,'admin_login'=>false, 'hasError'=>$hasError, 'errorTitle'=>$errorTitle]);
            }
        }else{
            return view('home', ['user_login'=>false, 'admin_login'=>false, 'hasError'=>$hasError, 'errorTitle'=>$errorTitle]);
        }
    }
    public function logout(Request $request){
        if($request->isLogin && Session::has('username') && Session::has('password') && Session::has('type')){
            Session::forget(['username', 'password', 'type']);
        }
        return redirect('/');
    }
}
