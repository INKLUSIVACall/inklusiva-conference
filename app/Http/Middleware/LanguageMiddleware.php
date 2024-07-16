<?php

namespace App\Http\Middleware;

use Closure;

class LanguageMiddleware
{
    /**
     * Setting the app-language based on the session or the browser language.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $language = session('language', config('app.locale'));
        app()->setLocale($language);

        return $next($request);
    }
}
