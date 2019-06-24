<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    //加载注册页
    public function index()
    {
        return view('register/index');
    }

    //执行注册操作
    public function register(Request $request)
    {
        //1.验证
        $request->validate([
            'name' => 'required|min:2|max:10',
            'email' => 'required|unique:users|min:6|max:50',
            'password' => 'required|min:6|max:16|confirmed',
        ]);

        //2.逻辑
        $user = new User;
        $user->name = request('name');
        $user->email = request('email');
        $user->password = bcrypt(request('password'));
        $user->save();

        //3.渲染
        return redirect('/login')->with('恭喜，注册成功！');
    }
}
