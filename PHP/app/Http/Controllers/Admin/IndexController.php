<?php
/**
 * Created by PhpStorm.
 * User: LONG JIN WEN
 * Date: 2017/6/5
 * Time: 14:05
 */

namespace App\Http\Controllers\Admin;

use App\Http\Model\Admin\Article;
use App\Http\Model\Admin\HomeHistory;
use App\Http\Model\Admin\PluginOptions;
use App\Http\Model\Admin\Product;
use Illuminate\Routing\Router;


class IndexController extends CommonController {

    public function index(Router $router) {


        $history = '';
        for ($i = 30; $i >= 0; $i--) {
            $t = strtotime(date('Y-m-d')) + 3600 * 24;
            $history .= '[';
            $history .= $t - $i * 3600 * 24;
            $history .= "000," . HomeHistory::where('create_time', '>=', $t - ($i + 1) * 3600 * 24)->where('create_time', '<', $t - $i * 3600 * 24)->count();
            $history .= '],';
        }
        //文章总数
        $articleCount = Article::count();
        //最近一周
        $weekArticleCount = Article::where('created_at', '>', date('Y-m-d H:i:s', strtotime('-7 days')))->count();
        //产品总数
        $productCount = Product::count();
        //最近一周
        $weekProductCount = Product::where('created_at', '>', date('Y-m-d H:i:s', strtotime('-7 days')))->count();

        //总访问
        $historyCount = HomeHistory::count();
        //最近一周
        $weekHistoryCount = HomeHistory::where('create_time', '>', date('Y-m-d H:i:s', strtotime('-7 days')))->count();
        //最近七条文章
        $sevenArticle = Article::orderBy('id', 'desc')->simplePaginate(7);

        //最近七个产品
        $sevenProduct = Product::orderBy('id', 'desc')->simplePaginate(7);
        //启用的插件数量
        $EnablePluginCount = PluginOptions::where('status', 2)->count();
        $AllPluginCount = PluginOptions::count();

        session(['breadcrumb' => ['url' => '', 'modular' => admin_language('common_home'), 'action' => admin_language('common_home')]]);
        return view('admin/index/index', compact('AllPluginCount', 'EnablePluginCount', 'sevenProduct', 'sevenArticle', 'weekHistoryCount', 'historyCount', 'history', 'articleCount', 'productCount', 'weekArticleCount', 'weekProductCount'), ['other' => ['navActive' => '/', 'navActiveSon' => '/']]);
    }

    /*
     * 测试
     * */
    public function test() {
        ob_start();
        readfile('http://10.68.100.102/SZVETRON-036-VETRONCMS-DEVELOPER/public/downloads/theme/plugin');//输出图片文件
        $file = ob_get_contents();
        ob_end_clean();
        $fp = fopen(public_path() . '/phone.rar', "w");
        fwrite($fp, $file);
        fclose($fp);
    }


}