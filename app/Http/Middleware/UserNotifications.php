<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Flasher\Notyf\Prime\NotyfInterface;


class UserNotifications
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if(session()->has('notification')){
            $notification = session()->get('notification');
            switch($notification['type']){
                case 'success':
                    notyf()->success($notification['message']);
                    break;
                case 'error':
                    notyf()->error($notification['message']);
                    break;
                case 'warning':
                    notyf()->warning($notification['message']);
                    break;
                case 'info':
                    notyf()->info($notification['message']);
                    break;
            }
        }
        return $next($request);
    }
}
