<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //加载登陆页
    public function index()
    {
        return view('login/index');
    }

    //执行登录
    public function login(Request $request)
    {
        //1.验证
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        //2.逻辑
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {

            //3.渲染
            return redirect('/posts')->with('success','登录成功！');
        }else{

            //3.渲染
            return back()->with('error','当前用户不存在或密码错误！');
        }


    }

    //执行退出
    public function logout()
    {
        \Auth::logout();

        return redirect('/posts')->with('success', '退出成功！');
    }
}
