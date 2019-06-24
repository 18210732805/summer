<?php

namespace App\Http\Controllers;

use App\User;
use App\Fan;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //加载个人中心页面
    public function show(User $user)
    {
        //1. 获取当前用户发布的所有文章
        $users = User::withCount(['posts','stars','fans'])->find($user->id);

        //2. 获取当前用户所有的关注列表
        $stars = $user->stars;
        $star_users = User::whereIn('id', $stars->pluck('star_id'))->withCount(['posts','stars','fans'])->get();

        //3. 获取当前用户所有的粉丝列表
        $fans = $user->fans;
        $fan_users = User::whereIn('id', $fans->pluck('fan_id'))->withCount(['posts','stars','fans'])->get();

        //3.
        return view('User/show', compact('users', 'star_users', 'fan_users'));
    }

    //加载个人设置页面
    public function setting()
    {
        return view('user/setting');
    }

    //执行个人信息修改的方法
    public function settingStore(Request $request)
    {
        //1.实例化User类
        $user = User::find(\Auth::id());

        //1.判断用户是否修改了头像
        if($request->hasFile('photo')){

            //2.执行图片的上传
            $user->photo = $request->photo->store('');

        }

        //3.获取修改后的用户名字
        $user->name = $request->name;

        //4.执行修改
        $user->save();

        //5.渲染
        return back()->with('success', '恭喜，头像修改成功！');
    }

    //执行关注的方法
    public function fan($id)
    {
        $fan = new Fan;
        $fan->star_id = $id;
        $fan->fan_id = \Auth::id();
        $res = $fan->save();

        if($res){
            return 'true';
        }else{
            return 'false';
        }
    }

    //执行取关的方法
    public function unfan($id)
    {
        $res = Fan::where('fan_id', \Auth::id())->where('star_id',$id)->delete();

        if($res){
            return 'true';
        }else{
            return 'false';
        }
    }
}
