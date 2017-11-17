<?php
/**
 * @Author: printempw
 * @Date:   2017-01-01 17:23:07
 * @Last Modified by:   printempw
 * @Last Modified time: 2017-01-01 17:26:42
 */

namespace Blessing\Longjinwen;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TestController extends Controller {
    public function welcome(Request $request) {
        dd($request->method());
        return view("Blessing\Longjinwen::index");
    }
}
