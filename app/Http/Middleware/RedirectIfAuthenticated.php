<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        // $guards = empty($guards) ? [null] : $guards;

        // foreach ($guards as $guard) {
        //     if (Auth::guard($guard)->check()) {
        //         return redirect(RouteServiceProvider::HOME);
        //     }
        // }

        // return $next($request);

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                // L'utilisateur est connecté, vérifions son rôle
                $user = Auth::guard($guard)->user();

                switch ($user->roles) {
                    case 'Utilisateur':
                        return redirect(RouteServiceProvider::HOME);
                         break;
                    case 'Administrateur':
                        // return redirect()->route('admin.dashboard');
                        return redirect(RouteServiceProvider::ADMIN);
                        break;
                    case 'Editeur':
                        //return redirect()->route('analytics');
                        return redirect(RouteServiceProvider::ADMIN);
                        break;
                    default:
                        return redirect(RouteServiceProvider::HOME);
                        break;
                }
            }
        }

        return $next($request);
    }
}
