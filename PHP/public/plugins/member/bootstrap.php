<?php


use App\Services\Hook;
use Illuminate\Contracts\Events\Dispatcher;


return function (Dispatcher $events) {


    Hook::addRoute(function ($router) {
        /**
         * 你也可以定义一个路由组，并指定组内路由的一些参数
         */
        $router->group([
            'middleware' => ['web'],
            'namespace' => 'Blessing\\Member',
        ], function ($router) {
            $router->get('/setting/member/default', 'IndexController@test');
            $router->get('/setting/member/more', 'IndexController@test');


            $router->get('/member/test', 'IndexController@test');
            $router->get('/member/member/member/member/member', 'IndexController@test');

        });


    });
};
