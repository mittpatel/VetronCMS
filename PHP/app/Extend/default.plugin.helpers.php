<?php

//系统插件辅助函数，包括插件的事件位置调用

if (!function_exists('plugin')) {

    function plugin($id) {
        return app('plugins')->getPlugin($id);
    }
}

if (!function_exists('plugin_assets')) {

    function plugin_assets($id, $relativeUri) {
        if ($plugin = plugin($id)) {
            return $plugin->assets($relativeUri);
        } else {
            throw new InvalidArgumentException("No such plugin.");
        }
    }
}


if (!function_exists('bs_header_extra')) {

    function bs_header_extra() {
        $extraContents = [];

        Event::fire(new App\Events\RenderingHeader($extraContents));

        return implode("\n", $extraContents);
    }
}
if (!function_exists('plugin_trans')) {
    function plugin_trans($plugin, $trans) {
        if ($plugin && $trans)
            return \App\Services\Repositories\OptionRepository::pluginTrans($plugin, $trans);
        return null;
    }
}








