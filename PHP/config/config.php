<?php
/**
 * Created by PhpStorm.
 * User: LONG JIN WEN
 * Date: 2017/6/15
 * Time: 19:03
 *
 * 该目录存放一些常用基础配置
 *
 */

return [

    /*
     * 主题目录配置文件
     * */
    'themeConfigFileName' => 'config.json',

    /*
    * 主题允许编辑的文件类型
    * */
    'themeAllowEditFileType' => ['txt', 'php', 'html', 'css', 'js', 'xml', 'json', 'htm'],

    /*
     *列表页禁用和启用颜色
     * */
    'listEnableColor' => '#0FAA0F',
    'listDisableColor' => '#c0a16b',

    /*
     * 产品默认属性值分割符
     * */
    'productAttributeDefaultValue' => '/',

    /*
     * 钩子配置文件名称
     * */
    'hookConfigFileName'=>'config.json',
    /*
     * 钩子配置url和方法的属性名
     * */
    'hookRouteConfigPropertyName'=>'routes',

    /*
     *查询数据函数集位置
     * */
    'homeFunctionPosition'=>base_path().'/app/Http/Controllers/Home/database.php'
];






