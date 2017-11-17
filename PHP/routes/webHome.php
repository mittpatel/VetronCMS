<?php
/**
 * Created by PhpStorm.
 * User: LONG JIN WEN
 * Date: 2017/6/5
 * Time: 11:17
 */

Route::group(['namespace' => 'Home'], function () {




    Route::get('/', 'IndexController@index');

    /*
     * 关于我们
     * */
    Route::get('about', 'PageController@about');


    /*
     * 文章类别
     * */
    Route::get('article/{categoryId?}', 'ArticleController@articleCategory');

    /*
     * 文章详情
     * */
    Route::get('details/{par1?}/{par2?}/{par3?}/{par4?}', 'ArticleController@details');

    /*
     * 产品首页
     * */
    Route::get('product', 'ProductController@product');

    /*
     * 产品类别
     * */
    Route::get('product/{categoryId?}', 'ProductController@productCategory');

    /*
     * 产品详情
     * */
    Route::get('product/{categoryId?}/{productId?}', 'ProductController@productDetails');

    /*
     * 设置语言
     * */
    Route::get('set/lang/{lang}', 'IndexController@setLang');

    Route::any('test/upload', 'IndexController@upload');

});