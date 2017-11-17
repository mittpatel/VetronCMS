<?php
/**
 * Created by PhpStorm.
 * User: LoJwen
 * Date: 2017/6/5
 * Time: 22:08
 */

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

class IndexController extends CommonController {
    public function index() {

        //默认首页设置
        $index = \App\Http\Model\Admin\HomeMenu::where(['index' => 1])->value('route');
        if ($index != '/' && $index) {
            //判断来源是否是前台,域名不一样
            if (!$_SESSION['HTTP_REFERER'] && !in_array($_SERVER['SERVER_NAME'], explode('/', $_SERVER['HTTP_REFERER']))) {
                return header('Location: ' . url($index));
            }
        }
        return view(THEME . '.index.index', ['other' => ['active' => '/']]);
    }

    public function setLang($language) {
        app()->setLocale($language);
        session()->put(['HOME_LOCALE' => $language]);
        return back();
    }

    public function upload(Request $request) {
        if ($request->isMethod('get')) {

            return view(THEME . '.index.upload');

        }
        if ($request->isMethod('post')) {
            return $_FILES['fileName'];
        }
    }

}


