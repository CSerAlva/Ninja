<?php

namespace App\Http\Middleware;

use App\Models\LogEntry;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class LogUserActions
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //获取当前用户Id,如果用户已登录
        $userId = Auth::id() ?? null;
        $log = new LogEntry([
            'user_id' => $userId,
            'action' => $request->method(),
            'description' => $request->fullUrl(),
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);
        $log->save();

        return $next($request);
    }
}
