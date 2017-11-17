<?php
/**
 * @Author: printempw
 * @Date:   2017-01-14 21:03:03
 * @Last Modified by:   printempw
 * @Last Modified time: 2017-01-20 21:34:04
 */
return [
    App\Events\PluginWasInstall::class => function () {
        dump('Install call');
    },

    App\Events\PluginWasEnabled::class => function (App\Services\PluginManager $manager, $plugins) {
        // 你也可以在回调函数的参数列表中使用类型提示，Laravel 服务容器将会自动进行依赖注入
        dump('Enabled call');
    },
    App\Events\PluginWasDisabled::class => function ($plugin) {
        // 回调函数被调用时 Plugin 实例会被传入作为参数
        dump('Disabled call');
    },
    App\Events\PluginWasDeleted::class => function () {
        dump('Deleted call');
    }

];
