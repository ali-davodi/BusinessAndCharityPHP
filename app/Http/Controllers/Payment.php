<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;

class Payment extends Controller
{
    public function request(Request $request, $id){
        if($request->isLogin && !$request->isAdmin){
            $page_data = ['title' => 'Payments', 'isLogin' => true];
            $data = DB::table('user_payment')
                ->where(['user_id' => $request->user->id, 'department_id' => $id])->get();
            return view('layouts.payment.paymentList', ['page' => $page_data, 'user' => $request->user, 'list' => $data, 'admin_login' => false, 'id' => $id]);
        } else {
            return redirect('/');
        }
    }
    public function list(Request $request){
        if($request->isLogin && $request->isAdmin){
            $payments = DB::table('user_payment')->get();
            $pays = DB::table('departments')->get();
            $pay = [];
            foreach($pays as $p){
                $pay[$p->id] = $p->name;
            }
            $page_data = ['title' => 'List of Payments', 'isLogin' => true];
            if(Session::get('type')=='admin'){
                return view('layouts.payment.paymentsList', ['page' => $page_data, 'user' => $request->user, 'admin_login' => true, 'payments' => $payments, 'pay' => $pay]);
            }
        } else {
            return redirect('/');
        }
    }
    public function create(Request $request, $id=false){
        if($request->isLogin && !$request->isAdmin){
            $page_data = ['title' => 'Create Department', 'isLogin' => true, 'created' => false];
            if(Session::get('type')=='user'){
                $type = 'create';
                if($request->has('title') && $request->has('description') && $type=='create'){
                    $request->validate([
                        'price' => 'required|min:3|max:20',
                        'title' => 'required|unique:departments,name|min:3|max:400',
                        'description' => 'required|min:3|max:1200'
                    ]);
                    DB::table('user_payment')->insert(
                        [
                            'code' => md5(sha1(md5(rand(1000,9999999)))),
                            'user_id' => $request->user->id,
                            'department_id' => $id,
                            'price' => $request->get('price'),
                            'title' => $request->get('title'),
                            'description' => $request->get('description'),
                            'active' => 0
                        ]
                    );
                    $page_data['created'] = true;
                }
                return view('layouts.payment.paymentCreateEdit', ['page' => $page_data, 'user' => $request->user, 'admin_login' => false, 'id' => $id, 'type' => $type]);
            } else {
                redirect('/payment/'.$id);
            }
        } else {
            return redirect('/');
        }
    }
    public function delete(Request $request, $id=false){
        if($request->isLogin && !$request->isAdmin && $id){
            DB::table('user_payment')
                ->where('department_id', $id)
                ->where('user_id', $request->user->id)->delete();
            return redirect('/payment/'.$id);
        }
    }
    public function paymentDelete(Request $request, $id=false){
        if($request->isLogin && $request->isAdmin && $id){
            DB::table('user_payment')
                ->where('id', $id)->delete();
            return redirect('/payments/list');
        }
    }
    public function paymentAct(Request $request, $id=false, $act='active'){
        if($request->isLogin && $request->isAdmin && $id){
            if($act=='active'){
                $act = 0;
                $new_act = 1;
            }
            elseif($act=='deactive'){
                $act = 1;
                $new_act = 0;
            }
            $check_validation = DB::table('user_payment')
                ->where(['id' => $id, 'active' => $act])->count();
            if($check_validation){
                DB::table('user_payment')
                    ->where(['id' => $id])
                    ->update(['active' => $new_act]);
            }
            return redirect('/payments/list');
        }
    }
}
