<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckNotificationReadAt
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if ($request->query('notify')){
            $notify = Auth::user()->unreadNotifications()
                ->where('id', $request->query('notify'))->first();

            if ($notify){
                $notify->markAsRead();
            }
        }

        if ($request->query('notify_admin')){
            $notify = Auth::guard('admin')->user()->unreadNotifications()
                ->where('id', $request->query('notify_admin'))->first();

            if ($notify){
                $notify->markAsRead();
            }
        }
        return $next($request);
    }
}
