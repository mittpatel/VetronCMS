<?php
/**
 * Created by PhpStorm.
 * User: LONG JIN WEN
 * Date: 2017/6/5
 * Time: 15:35
 */

namespace App\Http\Middleware;

use Closure;

class Language {

    public function handle($request, Closure $next) {
        if ($request->is('admin/*') || $request->path() == 'admin') {
            if (!session()->has('ADMIN_LOCALE')) {
                session()->put('ADMIN_LOCALE', env('ADMIN_LOCALE'));
                session()->save();
            }
            define('ADMIN_LOCALE', session()->get('ADMIN_LOCALE'));
            define('PLUGIN_LANG', ADMIN_LOCALE);
            app()->setLocale(ADMIN_LOCALE);
        } else {
            if (!session()->has('HOME_LOCALE')) {
                session()->put('HOME_LOCALE', env('HOME_LOCALE'));
                session()->save();
                \App\Http\Model\Admin\HomeHistory::insert([
                    'browser' => $_SERVER['HTTP_USER_AGENT'],
                    'ip' => $request->ip(),
                    'create_time' => time()
                ]);
            }
            define('HOME_LOCALE', session()->get('HOME_LOCALE'));
            define('PLUGIN_LANG', HOME_LOCALE);
            app()->setLocale(session()->get('HOME_LOCALE'));
        }


        return $next($request);
    }
}