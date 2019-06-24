<?php

namespace App\Http\Middleware;

use Closure;

class CheckUser
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
        //判断用户是否登录
        if(\Auth::check()){

            //执行下一步操作(请求)
            return $next($request);
        }else{

            return redirect('/login')->with('error','请登录后再进行操作！');
        }
    }
}
