<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Illuminate\Support\Facades\Auth;
class ManagerController extends Controller
{
    public function login(){
        return view('admin/manager/login');
    }
    public function login_check(Request $request){
        $rules=[
            'username'=>'required',
            'password'=>'required|between:6,12'
        ];
        $msgs=[
            'username.required'=>'用户名不能为空',
            'password.required'=>'密码不能为空',
        ];
        $valiator=Validator::make($request->all(),$rules,$msgs);
        if($valiator->passes()){
            $res=Auth::guard('admin')->attempt($request->only('username','password'),$request->has('online'));
            if($res){
                return redirect('admin/index');
            }else{
                return back()->withErrors(['error'=>'用户名或密码错误']);
            }
        }else{
            return back()->withErrors($valiator);
        }
    }
    public function logout(){
        Auth::guard('admin')->logout();
        return view('admin.manager.login');
    }
}
