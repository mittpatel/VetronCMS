<?php

/**
 * Created by PhpStorm.
 * User: LONG JIN WEN
 * Date: 2017/7/6
 * Time: 18:19
 */

namespace App\Http\Controllers\Home;

use Illuminate\Support\Facades\DB;

class ProductController extends CommonController {

    /*
     * 产品首页
     * */
    public function product() {
        return view(THEME . '.product.product', ['other' => ['active' => 'product']]);
        dd(getProductAll());
    }

    /*
     * 产品分类
     * */
    public function productCategory($categoryId) {
        dd(getProductFromCategory($categoryId, 2, true));
    }

    /*
     * 产品详情
     * */
    public function productDetails($categoryId, $productId) {

        $res = DB::table('product')
            ->where(function ($query) {
                $query->where('status', '=', 1)
                    ->where('name', '=', 1);
            })
            ->orWhere(function ($query) {
                $query->where('status', '=', 2)
                    ->where('name', '=', 1);
            })
            ->tosql();
        dd($res);
        dd(getProductDetails($productId));
    }

}