<?php

namespace App\Http\Middleware;

use Closure;
use Predis;

class WechatAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $input = $request->all();
        if ($request->has('uid')) {
            if (Predis::exists('wechat.user:' . $input['uid'])) {
                return $next($request);
            }
        }

//        echo $request->url();
//        if(Predis::exists('user:'.$_SERVER['HTTP_AUTHORIZATION'])){
//            return $next($request);
//        }
        return redirect('/register')->withInput($request->only('uid'));
    }
}
