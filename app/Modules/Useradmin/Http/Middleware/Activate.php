<?php

namespace App\Modules\Useradmin\Http\Middleware;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;

class Activate extends Middleware
{
    public function handle($request, Closure $next, ...$guards)
    {
        // Get the authenticated user
        if (Auth::user() === null) {
            $user = User::where('email', $request->email)->first();
            if ($user === null) {
                return $next($request);
            }
        } else {
            $user = Auth::user();
        }

        // Check if the given attribute is set
        if ($user->activated_at === null) {
            return redirect()->route(RouteServiceProvider::NOT_VERIFIED);
        }

        return $next($request);
    }
}
