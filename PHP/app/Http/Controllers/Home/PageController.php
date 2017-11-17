<?php

/**
 * Created by PhpStorm.
 * User: LONG JIN WEN
 * Date: 2017/7/6
 * Time: 18:19
 */

namespace App\Http\Controllers\Home;
class PageController extends CommonController {
    public function about() {
        return view(THEME . '.page.about',['other'=>['active'=>'about']]);
    }
}