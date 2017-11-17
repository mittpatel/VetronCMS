<?php
/**
 * Created by PhpStorm.
 * User: LONG JIN WEN
 * Date: 2017/8/16
 * Time: 13:56
 */

namespace Blessing\Member;

use App\Http\Controllers\Controller;

class IndexController extends Controller {
    public function test() {
        echo plugin_trans('member', 'Test');

        return view("Blessing\Member::test.index");
    }
}