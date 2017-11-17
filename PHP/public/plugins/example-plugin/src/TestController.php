<?php
/**
 * @Author: printempw
 * @Date:   2017-01-01 17:23:07
 * @Last Modified by:   printempw
 * @Last Modified time: 2017-01-01 17:26:42
 */

namespace Blessing\ExamplePlugin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TestController extends Controller
{
    public function welcome($name)
    {
       /*return view("Blessing\\ExamplePlugin::index");*/
       
       
       $content = <<< EOT
{
  "name": "example-plugin",
  "version": "1.0",
  "title": "示例插件",
  "description": "可以直接创建此插件的副本并在其基础上开发新的插件，其代码也兼具插件开发文档功能（其实就是我懒得写文档）",
  "author": "printempw",
  "url": "https://blessing.studio/",
  "namespace": "Blessing\\ExamplePlugin",
  "config": "config.tpl"
}
EOT;
	   
	   echo $content;
       
       
    }

}
