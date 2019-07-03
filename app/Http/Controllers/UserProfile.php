<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Session;
use DB;

class UserProfile extends Controller
{
    public function show(Request $request){
        $hasError = false;
        $errorTitle = '';
        if($request->hasError){
            $hasError = true;
            $errorTitle = 'Login Error!!!';
        }
        if($request->isLogin){
            $user = $request->user;
            if($request->isAdmin){
                $page_data = ['title'=>'Admin Panel'];
                return view('home', ['user'=>$user,'user_login'=>false,'admin_login'=>true, 'hasError'=>$hasError, 'errorTitle'=>$errorTitle, 'page'=>$page_data]);
            } else {
                $page_data = ['title'=>'User Panel'];
                return view('home', ['user'=>$user,'user_login'=>true,'admin_login'=>false, 'hasError'=>$hasError, 'errorTitle'=>$errorTitle, 'page'=>$page_data]);
            }
        }else{
            $user_type = 'user';
            $page_data = ['title'=>'User Login'];
            if($request->user_type){
                $page_data = ['title'=>'Admin Login'];
                $user_type = $request->user_type;
            }
            if($request->has('username') && $request->has('type')){
                Validator::make([$request->get('type')], [
                    'zones' => [
                        'required',
                        Rule::in(['user', 'admin']),
                    ],
                ]);
                $request->validate([
                    'username' => 'required|min:3|max:191',
                    'password' => 'required|min:3|max:191'
                ]);
            }
            return view('login', ['user_type'=> $user_type,'user_login'=>false, 'admin_login'=>false, 'hasError'=>$hasError, 'errorTitle'=>$errorTitle, 'page'=>$page_data]);
        }
    }
    public function admin(Request $request){
        $request->user_type = 'admin';
        return $this->show($request);
    }
    public function register(Request $request){
        if(!$request->isLogin){
            $page_data = ['title'=>'User Register', 'created'=>false];
            if($request->has('username') && $request->has('fullname')){
                $request->validate([
                    'fullname' => 'required|min:3|max:191',
                    'username' => 'required|unique:users,username|min:3|max:191',
                    'password' => 'required|same:repassword|min:3|max:191',
                    'repassword' => 'required|same:password|min:3|max:191',
                    'agree' => 'accepted',
                ]);
                DB::table('users')->insert(
                    [
                        'fullname' => $request->get('fullname'),
                        'username' => $request->get('username'),
                        'password' => md5(sha1(sha1(md5($request->get('password'))))),
                        'type' => 'user',
                        'active' => 1
                    ]
                );
                $page_data['created'] = true;
            }
            return view('register', ['page'=>$page_data]);
        }
    }
    public function logout(Request $request){
        if($request->isLogin && Session::has('username') && Session::has('password') && Session::has('type')){
            Session::forget(['username', 'password', 'type']);
        }
        return redirect('/');
    }
}
