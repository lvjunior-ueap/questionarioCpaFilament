<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class SessionTimeout
{
    /**
     * Handle an incoming request - logout automático por inatividade
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $timeout = config('session.lifetime') * 60; // Convert to seconds

        if (Auth::check()) {
            $lastActivity = session('last_activity');
            $now = now()->timestamp;

            if ($lastActivity && ($now - $lastActivity) > $timeout) {
                Auth::logout();
                session()->flush();
                
                return redirect()->route('login')->with('warning', 'Sua sessão expirou por inatividade. Por favor, faça login novamente.');
            }

            session(['last_activity' => $now]);
        }

        return $next($request);
    }
}
