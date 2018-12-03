<?php

namespace App\Http\Middleware;

use Closure;

class Language
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
        // Ci assicuriamo che la locale esista
        $locale = $request->segment(1);

        if (! array_key_exists($locale, config('app.locales'))) {
            $segments = $request->segments();
            array_unshift($segments, config('app.fallback_locale'));

            $newUrl = implode('/', $segments);

            return redirect($newUrl);
        }

        app()->setLocale($locale);

        return $next($request);
    }
}
