<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use DB;
use Validator;

class UserCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $request->isLogin = 0;
        $user = false;
        $pass = false;
        if(Session::has('username') && Session::has('password') && Session::has('type')){
            $user = Session::get('username');
            $pass = Session::get('password');
            $type = Session::get('type');
        }
        $from_login_form = false;
        if($request->has('username') && $request->has('password') && $request->has('type') && !$user && !$pass){
            $from_login_form = true;
            $user = $request->get('username');
            $pass = $request->get('password');
            $type = $request->get('type');
            $pass = md5(sha1(sha1(md5($pass))));
        }
        if($user && $pass){
            $user_count = DB::table('users')->where([
                'username'=>$user,
                'password'=>$pass,
                'type'=>$type,
                'active'=>1
            ])->get();
            if($user_count[0]){
                $user = $user_count[0];
                $user_id = $user->id;
                $user->departments = DB::table('user_departments')->where([
                    'user_id'=>$user_id,
                    'active'=>1
                ])->get();
                $user->communicate = DB::table('user_communicate')->where([
                    'user_id'=>$user_id,
                    'read'=>0,
                    'active'=>1
                ])->get();
                $request->user = $user;
                $request->isLogin = 1;
                if($from_login_form){
                    session(['username'=>$user, 'password'=>$pass, 'type'=>$type]);
                }
                if($type=='admin')
                    $request->isAdmin = 1;
            } else {
                if($from_login_form){
                    $request->hasError = 1;
                }
            }
        }
        return $next($request);
    }
}
