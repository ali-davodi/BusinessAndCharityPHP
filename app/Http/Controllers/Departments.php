<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Session;
use DB;

class Departments extends Controller
{
    public function request(Request $request){
        if($request->isLogin && !$request->isAdmin){
            $in_request = false;
            if($request->has('request_department')){
                $request->validate([
                    'request_department' => 'required|numeric|gt:0',
                ]);
                $name = DB::table('departments')->where('id', $request->get('request_department'))->get('name');
                $in_request = '';
                if(isset($name[0])){
                    $in_request = $name[0]->name;
                }
                $check_request = DB::table('user_departments')
                    ->where(['user_id' => $request->user->id, 'department_id' => $request->get('request_department')])
                    ->count();
                if(!$check_request){
                    DB::table('user_departments')->insert(
                        ['user_id' => $request->user->id, 'department_id' => $request->get('request_department'), 'active' => 0]
                    );
                }
            }
            $page_data = ['title' => 'Request Department', 'isLogin' => true];
            $data = DB::table('departments')
                ->whereNotIn('id', DB::table('user_departments')->where('user_id', $request->user->id)->pluck('department_id')->toArray())
                ->where('active', 1)
                ->get();
            return view('layouts.departments.departmentRequest', ['page' => $page_data, 'user' => $request->user, 'dept' => $data, 'admin_login' => false, 'in_request' => $in_request]);
        } else {
            return redirect('/');
        }
    }
    public function getDepartment(Request $request, $id=false, $name=false){
        if($request->isLogin && !$request->isAdmin){
            $data = DB::table('departments')
                ->whereIn('id', DB::table('user_departments')->where('user_id', $request->user->id)->pluck('department_id')->toArray())
                ->where('id', $id)->get()->first();
            $page_data = ['title' => 'Department : '.$data->name, 'isLogin' => true];
            if($data){
                return view('layouts.departments.departmentGet', ['page' => $page_data, 'user' => $request->user, 'admin_login' => false, 'dept' => $data, 'id' => $id]);
            }
        }
    }
    public function list(Request $request){
        if($request->isLogin && $request->isAdmin){
            $departments = DB::table('departments')->get();
            $page_data = ['title' => 'List of Departments', 'isLogin' => true];
            if(Session::get('type')=='admin'){
                return view('layouts.departments.departmentList', ['page' => $page_data, 'user' => $request->user, 'admin_login' => true, 'departments' => $departments]);
            }
        } else {
            return redirect('/');
        }
    }
    public function delete(Request $request, $id=false){
        if($request->isLogin && $request->isAdmin && $id){
            DB::table('departments')->where('id', $id)->delete();
            return redirect('/departments/list');
        }
    }
    public function users(Request $request, $id=false){
        if($request->isLogin && $request->isAdmin && $id){
            $data = DB::table('departments')->where('id', $id)->get()->first();
            if($data){
                $dept_users = DB::table('user_departments')
                    ->select(DB::raw('user_departments.id, user_departments.active, users.fullname, users.username'))
                    ->join('users', 'users.id', '=', 'user_departments.user_id')
                    ->where('department_id', $id)->get();
                $page_data = ['title' => 'Department Users of "'.$data->name.'"', 'isLogin' => true];
                return view('layouts.departments.departmentUsers', ['page' => $page_data, 'user' => $request->user, 'admin_login' => true, 'dept_users' => $dept_users, 'id' => $id]);
            }
        }
    }
    public function usersAction(Request $request, $id=false, $dept_id=false, $act='active'){
        if($request->isLogin && $request->isAdmin && $id && $dept_id){
            if($act=='active'){
                $act = 0;
                $new_act = 1;
            }
            elseif($act=='deactive'){
                $act = 1;
                $new_act = 0;
            }
            $check_validation = DB::table('user_departments')
                ->where(['id' => $dept_id, 'department_id' => $id, 'active' => $act])->count();
            if($check_validation){
                DB::table('user_departments')
                    ->where(['id' => $dept_id, 'department_id' => $id])
                    ->update(['active' => $new_act]);
            }
            return redirect('/departments/users/'.$id);
        }
    }
    public function create(Request $request, $id=false){
        if($request->isLogin && $request->isAdmin){
            $edit_validation = true;
            if($id){
                $data_get = DB::table('departments')->where('id', $id)->get();
                if(isset($data_get[0])){
                    $data_get = $data_get[0];
                    $page_data = ['title' => 'Edit Department "'.$data_get->name.'"', 'isLogin' => true, 'created' => false, 'id' => $id, 'data' => $data_get];
                } else {
                    $edit_validation = false;
                }
            } else {
                $page_data = ['title' => 'Create Department', 'isLogin' => true, 'created' => false];
            }
            if(Session::get('type')=='admin' && $edit_validation){
                if($id){
                    $type = 'edit';
                } else {
                    $type = 'create';
                }
                if($request->has('name') && $request->has('description') && $type=='create'){
                    $request->validate([
                        'name' => 'required|unique:departments,name|min:3|max:400',
                        'description' => 'required|min:3|max:1200',
                    ]);
                    $active = 0;
                    if($request->has('active')){
                        $active = 1;
                    }
                    DB::table('departments')->insert(
                        [
                            'name' => $request->get('name'),
                            'description' => $request->get('description'),
                            'active' => $active
                        ]
                    );
                    $page_data['created'] = true;
                }
                if($request->has('name') && $request->has('description') && $type=='edit'){
                    $pass_data = ['name' => $request->get('name')];
                    $validator = Validator::make($pass_data, [
                        'name' => [
                            'required',
                            Rule::unique('departments')->ignore($id),
                        ],
                    ]);
                    if($validator->fails()){
                        $page_data['error'] = $validator->errors()->first('name');
                    } else {
                        $request->validate([
                            'description' => 'required|min:3|max:1200',
                        ]);
                        $active = 0;
                        if($request->has('active')){
                            $active = 1;
                        }
                        DB::table('departments')
                            ->where('id', $id)
                            ->update(
                                [
                                    'name' => $request->get('name'),
                                    'description' => $request->get('description'),
                                    'active' => $active
                                ]
                        );
                        $page_data['created'] = true;
                    }
                }
                return view('layouts.departments.departmentCreateEdit', ['page' => $page_data, 'user' => $request->user, 'admin_login' => true, 'type' => $type]);
            } else {
                redirect('/departments/list');
            }
        } else {
            return redirect('/');
        }
    }
}
