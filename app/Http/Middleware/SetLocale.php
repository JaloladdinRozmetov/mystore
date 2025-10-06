<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->is('livewire*') or $request->is('admin*')) {
            return $next($request);
        }

        $locale = $request->segment(1); // first segment
        $availableLocales = config('app.available_locales', ['uz', 'ru', 'en']);

        if (in_array($locale, $availableLocales)) {
            App::setLocale($locale);
        } else {
            $locale = config('app.locale', 'uz');
            return redirect()->to($locale . '/' . $request->path());
        }

        return $next($request);
    }
}
