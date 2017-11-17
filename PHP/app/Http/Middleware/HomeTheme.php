<?php
/**
 * Created by PhpStorm.
 * User: LONG JIN WEN
 * Date: 2017/6/27
 * Time: 16:26
 */

namespace App\Http\Middleware;


use Closure;

class HomeTheme {

    public function handle($request, Closure $next) {

		//获取当前启用的主题
        $active = \App\Http\Controllers\Admin\ThemeController::getActiveTheme();
        if ($active) define('THEME', 'home.' . $active);
        else define('THEME', 'home.default');
        define('THEME_ASSET', asset('template/home/' . $active));

        //前台菜单
        $GLOBALS['homeMenu'] = \App\Http\Model\Admin\HomeMenu::where('is_show',1)->orderBy('order')->get();
        if (file_exists(config('config.homeFunctionPosition'))) {
            require config('config.homeFunctionPosition');
        }
        //文章url模式
        define('ARTICLE_URL_MODEL',config('aSetting.home_RouteModel',1));

		
        return $next($request);

    }
}