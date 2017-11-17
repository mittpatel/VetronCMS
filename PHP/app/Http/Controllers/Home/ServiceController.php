<?php

/**
 * Created by PhpStorm.
 * User: LONG JIN WEN
 * Date: 2017/7/6
 * Time: 18:19
 */

namespace App\Http\Controllers\Home;
class ServiceController extends CommonController {
    public function service() {
        return view(THEME . '.service.service', ['other' => ['active' => 'service']]);
    }
}