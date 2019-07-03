<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;

class Communication extends Controller
{
    public function request(Request $request, $id){
        if($request->isLogin && !$request->isAdmin){
            $data = DB::table('user_communicate')
                ->select(
                    'user_communicate.id',
                    'user_communicate.user_id',
                    'user_communicate.department_id',
                    'user_communicate.title',
                    'user_communicate.description',
                    'users.fullname',
                    'users.username'
                )
                ->join('users', 'users.id', '=', 'user_communicate.user_id')
                ->where(['department_id' => $id])
                ->orderByRaw('user_communicate.id DESC')->get();
            $query = DB::table('departments')->where('id', $id)->get()->first();
            if($query){
                $page_data = ['title' => 'Communications of "'.$query->name.'"', 'isLogin' => true];
            }
            return view('layouts.communication.communicationList', ['page' => $page_data, 'user' => $request->user, 'list' => $data, 'admin_login' => $request->isAdmin, 'id' => $id]);
        } else {
            return redirect('/');
        }
    }
    public function list(Request $request, $id){
        if($request->isLogin && $request->isAdmin){
            $communications =DB::table('user_communicate')
            ->select(
                'user_communicate.id',
                'user_communicate.user_id',
                'user_communicate.department_id',
                'user_communicate.title',
                'user_communicate.description',
                'users.fullname',
                'users.username'
            )
            ->join('users', 'users.id', '=', 'user_communicate.user_id')
            ->where(['department_id' => $id])
            ->orderByRaw('user_communicate.id DESC')->get();
            $dep = DB::table('departments')->where('id', $id)->get()->first();
            $page_data = ['title' => 'List of Communication "'.$dep->name.'"', 'isLogin' => true];
            if(Session::get('type')=='admin'){
                return view('layouts.communication.communicationsList', ['page' => $page_data, 'user' => $request->user, 'admin_login' => true, 'communications' => $communications, 'id' => $id]);
            }
        } else {
            return redirect('/');
        }
    }
    public function create(Request $request, $id=false){
        if($request->isLogin && !$request->isAdmin){
            $query = DB::table('departments')->where('id', $id)->get()->first();
            if($query){
                $page_data = ['title' => 'Create Communication for '.$query->name, 'isLogin' => true, 'created' => false];
            }
            if(Session::get('type')=='user'){
                $type = 'create';
                if($request->has('title') && $request->has('description') && $type=='create'){
                    $request->validate([
                        'title' => 'required|min:3|max:400',
                        'description' => 'required|min:3|max:1200'
                    ]);
                    DB::table('user_communicate')->insert(
                        [
                            'user_id' => $request->user->id,
                            'department_id' => $id,
                            'title' => $request->get('title'),
                            'description' => $request->get('description'),
                            'active' => 1,
                            'read' => 1
                        ]
                    );
                    $page_data['created'] = true;
                }
                return view('layouts.communication.communicationCreateEdit', ['page' => $page_data, 'user' => $request->user, 'admin_login' => false, 'id' => $id, 'type' => $type, 'dept' => $query]);
            } else {
                redirect('/communication/'.$id);
            }
        } else {
            return redirect('/');
        }
    }
    public function delete(Request $request, $id=false){
        if($request->isLogin && !$request->isAdmin && $id){
            DB::table('user_communicate')
                ->where('department_id', $id)
                ->where('user_id', $request->user->id)->delete();
            return redirect('/communication/'.$id);
        }
    }
    public function communicationCreate(Request $request, $id=false){
        if($request->isLogin && $request->isAdmin && $id){
            $query = DB::table('departments')->where('id', $id)->get()->first();
            if($query){
                $page_data = ['title' => 'Create Communication for '.$query->name, 'isLogin' => true, 'created' => false];
            }
            if(Session::get('type')=='admin'){
                $type = 'create';
                if($request->has('title') && $request->has('description') && $type=='create'){
                    $request->validate([
                        'title' => 'required|min:3|max:400',
                        'description' => 'required|min:3|max:1200'
                    ]);
                    DB::table('user_communicate')->insert(
                        [
                            'user_id' => $request->user->id,
                            'department_id' => $id,
                            'title' => $request->get('title'),
                            'description' => $request->get('description'),
                            'active' => 1,
                            'read' => 1
                        ]
                    );
                    $page_data['created'] = true;
                }
                return view('layouts.communication.communicationsCreateEdit', ['page' => $page_data, 'user' => $request->user, 'admin_login' => false, 'id' => $id, 'type' => $type, 'dept' => $query]);
            } else {
                redirect('/communication/'.$id);
            }
        } else {
            return redirect('/');
        }
    }
    public function communicationDelete(Request $request, $id=false){
        if($request->isLogin && $request->isAdmin && $id){
            $dept_id = DB::table('user_communicate')
                ->where('id', $id)->get('department_id')->first();
            DB::table('user_communicate')
                ->where('id', $id)->delete();
            return redirect('/communications/'.$dept_id->department_id);
        }
    }
}
