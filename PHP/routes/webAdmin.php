<?php
/**
 * Created by PhpStorm.
 * User: LONG JIN WEN
 * Date: 2017/6/5
 * Time: 11:28
 */




Route::group(['middleware' => [], 'prefix' => 'admin', 'namespace' => 'Admin'], function () {

    Route::any('login', 'LoginController@login');
    Route::any('logout', 'LoginController@logout');

});

Route::group(['middleware' => ['login'], 'prefix' => 'admin', 'namespace' => 'Admin'], function () {

    /*
     * 首页
     * */
    Route::any('index', 'IndexController@index');
    Route::any('/', 'IndexController@index');


    /*
     * 设置语言
     * */
    Route::get('setting/setLanguage/{language}', 'SettingController@setLanguage');
    /*
     * 测试邮件配置
     * */
    Route::get('setting/sendEmailTest', 'SettingController@sendEmailTest');


    /*
     * 后台菜单
     * */
    Route::get('setting/menu', ['uses' => 'MenuController@menuList', 'auth' => 'menuAdminList']);
    Route::any('setting/menu/add', ['uses' => 'MenuController@menuAdd', 'auth' => 'menuAdminAdd']);
    Route::any('setting/menu/edit/{id}', ['uses' => 'MenuController@menuEdit', 'auth' => 'menuAdminEdit']);
    Route::any('setting/menu/delete/{id}', ['uses' => 'MenuController@menuDelete', 'auth' => 'menuAdminDelete']);


    /*
     * 系统一般设置
     * */
    Route::any('setting/default', ['uses' => 'SettingController@settingDefault', 'auth' => 'settingDefault']);
    Route::post('ajaxUploadLogoIcon', ['uses' => 'SettingController@ajaxUploadLogoIcon', 'auth' => 'settingDefault']);


    /*
     * 管理语言包
     * */
    Route::get('setting/language', ['uses' => 'LanguageController@language', 'auth' => 'settingLanguage']);
    Route::any('setting/language/add', ['uses' => 'LanguageController@add', 'auth' => 'settingLanguage']);
    Route::any('setting/language/edit/{language?}/{fileName?}', ['uses' => 'LanguageController@edit', 'auth' => 'settingLanguage']);
    Route::any('setting/language/delete/{id?}', ['uses' => 'LanguageController@delete', 'auth' => 'settingLanguage']);
    Route::get('setting/language/status/{id?}', ['uses' => 'LanguageController@status', 'auth' => 'settingLanguage']);
    Route::get('setting/language/active/{id?}', ['uses' => 'LanguageController@active', 'auth' => 'settingLanguage']);
    Route::get('setting/setting/check/onlykey', ['uses' => 'LanguageController@checkLangKeyOnly', 'auth' => 'settingLanguage']);

    /*
     * 主题
     * */
    Route::get('setting/theme', ['uses' => 'ThemeController@theme', 'auth' => 'settingTheme']);
    Route::get('setting/theme/action', ['uses' => 'ThemeController@action', 'auth' => 'settingTheme']);
    Route::any('setting/theme/{theme?}', ['uses' => 'ThemeController@themeFileList', 'auth' => 'settingTheme']);
    Route::get('setting/theme/change/FolderName', ['uses' => 'ThemeController@changeFolderName', 'auth' => 'settingTheme']);
    Route::any('setting/theme/change/file', ['uses' => 'ThemeController@changeFile', 'auth' => 'settingTheme']);
    Route::any('setting/theme/change/delete', ['uses' => 'ThemeController@changeFileDelete', 'auth' => 'settingTheme']);
    Route::any('setting/theme/add', ['uses' => 'ThemeController@add', 'auth' => 'settingTheme']);
    Route::get('setting/theme/delete/cache', ['uses' => 'ThemeController@delCache', 'auth' => 'settingTheme']);
    /*
     * 文章
     * */
//    分类
    Route::get('article/category', ['uses' => 'ArticleController@articleCategory', 'auth' => 'articleCategory']);
    Route::any('article/category/add', ['uses' => 'ArticleController@articleCategoryAdd', 'auth' => 'articleCategoryAdd']);
    Route::any('article/category/edit/{id?}', ['uses' => 'ArticleController@articleCategoryEdit', 'auth' => 'articleCategoryEdit']);
    Route::get('article/category/delete/{id?}', ['uses' => 'ArticleController@articleCategoryDelete', 'auth' => 'articleCategoryDelete']);
//    文章列表
    Route::get('article', ['uses' => 'ArticleController@articleList', 'auth' => 'articleList']);
    Route::get('article/delete/{id?}', ['uses' => 'ArticleController@articleDelete', 'auth' => 'articleDelete']);
    Route::any('article/add', ['uses' => 'ArticleController@articleAdd', 'auth' => 'articleAdd']);
    Route::any('article/edit/{id}', ['uses' => 'ArticleController@articleEdit', 'auth' => 'articleEdit']);


    /*
     * 产品
     * */
//    分类
    Route::get('product/category', ['uses' => 'ProductController@productCategory', 'auth' => 'productCategory']);
    Route::any('product/category/add', ['uses' => 'ProductController@productCategoryAdd', 'auth' => 'productCategoryAdd']);
    Route::any('product/category/edit/{id?}', ['uses' => 'ProductController@productCategoryEdit', 'auth' => 'productCategoryEdit']);
    Route::any('product/category/delete/{id?}', ['uses' => 'ProductController@productCategoryDelete', 'auth' => 'productCategoryDelete']);
//    产品
    Route::get('product', ['uses' => 'ProductController@productList', 'auth' => 'productList']);
    Route::any('product/add', ['uses' => 'ProductController@productAdd', 'auth' => 'productAdd']);
    Route::any('product/edit/{id}', ['uses' => 'ProductController@productEdit', 'auth' => 'productEdit']);
    Route::get('product/delete/{id}', ['uses' => 'ProductController@productDelete', 'auth' => 'productDelete']);
//    属性
    Route::get('product/attribute/group', ['uses' => 'ProductController@attributeGroup', 'auth' => 'productAttributeGroup']);
    Route::any('product/attribute/group/add', ['uses' => 'ProductController@attributeGroupAdd', 'auth' => 'attributeGroupAdd']);
    Route::any('product/attribute/group/edit/{id}', ['uses' => 'ProductController@attributeGroupEdit', 'auth' => 'attributeGroupEdit']);
    Route::any('product/attribute/group/delete/{id}', ['uses' => 'ProductController@attributeGroupDelete', 'auth' => 'attributeGroupDelete']);
    Route::any('product/attribute/type/edit/{id}', ['uses' => 'ProductController@attributeTypeEdit', 'auth' => 'attributeTypeEdit']);
    Route::any('product/attribute/type/add', ['uses' => 'ProductController@attributeTypeAdd', 'auth' => 'attributeTypeAdd']);
    Route::any('product/add/attribute/add', ['uses' => 'ProductController@productAttributeTypeAdd', 'auth' => 'productAttributeTypeAdd']);

    /*
     * 媒体
     * */
    Route::get('media', ['uses' => 'MediaController@mediaLists', 'auth' => 'media']);


    Route::any('upload/all', ['uses' => 'UploadController@getAllList', 'auth' => '']);
    Route::any('upload/path', ['uses' => 'UploadController@getPathList', 'auth' => '']);
    Route::any('upload/create/folder', ['uses' => 'UploadController@createFolder', 'auth' => '']);
    Route::any('upload/delete/filedir', ['uses' => 'UploadController@deleteFileAdir', 'auth' => '']);
    Route::post('ajaxOnLineFiles', ['uses' => 'CommonController@ajaxOnLineFiles', 'auth' => '']);


    /*
     * 简介、更改资料
     * */
    Route::get('profile', 'ProfileController@profile');
    Route::post('changeProfile', 'ProfileController@changeProfile');
    Route::post('ajaxUploadHeader', 'ProfileController@ajaxUploadHeader');


    /*
     * 相册
     * */
    //分类
    Route::get('gallery/category', ['uses' => 'GalleryController@galleryCategory', 'auth' => 'galleryCategory']);
    Route::any('gallery/category/add', ['uses' => 'GalleryController@galleryCategoryAdd', 'auth' => 'galleryCategoryAdd']);
    Route::any('gallery/category/edit/{id?}', ['uses' => 'GalleryController@galleryCategoryEdit', 'auth' => 'galleryCategoryEdit']);
    Route::get('gallery/category/delete/{id?}', ['uses' => 'GalleryController@galleryCategoryDelete', 'auth' => 'galleryCategoryDelete']);
    Route::any('gallery/category/ajaxUpload', ['uses' => 'GalleryController@ajaxUploadGalleryCategory', 'auth' => 'galleryCategoryAdd']);
    //相册
    Route::get('gallery', ['uses' => 'GalleryController@galleryList', 'auth' => 'galleryList']);
    Route::get('ajaxGetGallery', ['uses' => 'GalleryController@ajaxGetGallery', 'auth' => 'galleryList']);
    Route::get('gallery/delete/{id}', ['uses' => 'GalleryController@galleryDelete', 'auth' => 'galleryDelete']);
    Route::any('gallery/add/{id}', ['uses' => 'GalleryController@galleryAdd', 'auth' => 'galleryAdd']);
    Route::post('gallery/ajaxUpload', ['uses' => 'GalleryController@ajaxUploadGallery', 'auth' => 'galleryAdd']);


    /*
     * 插件
     * */
    Route::get('plugin', ['uses' => 'PluginController@pluginList', 'auth' => 'plugin']);
    Route::get('plugin/action/{method?}/{name?}', ['uses' => 'PluginController@action', 'auth' => 'plugin']);

    /*
     * 前台菜单
     * */
    Route::get('setting/homemenu', ['uses' => 'MenuController@homeMenuList', 'auth' => 'homeMenuList']);
    Route::any('setting/homemenu/add', ['uses' => 'MenuController@homeMenuAdd', 'auth' => 'homeMenuAdd']);
    Route::any('setting/homemenu/edit/{id?}', ['uses' => 'MenuController@homeMenuEdit', 'auth' => 'homeMenuEdit']);
    Route::get('setting/homemenu/status', ['uses' => 'MenuController@homeMenuStatus', 'auth' => 'homeMenuEdit']);
    Route::get('setting/homemenu/delete/{id?}', ['uses' => 'MenuController@homeMenuDelete', 'auth' => 'homeMenuDelete']);


    /*
     * 管理员组
     * */
    Route::get('administrators/group', ['uses' => 'AdminsController@groupList', 'auth' => 'administratorsGroup']);
    Route::any('administrators/group/add', ['uses' => 'AdminsController@groupAdd', 'auth' => 'administratorsGroup']);
    Route::any('administrators/group/edit/{id?}', ['uses' => 'AdminsController@groupEdit', 'auth' => 'administratorsGroup']);
    Route::get('administrators/group/delete/{id?}', ['uses' => 'AdminsController@groupDelete', 'auth' => 'administratorsGroup']);
    Route::any('administrators/group/auth/{id?}', ['uses' => 'AdminsController@groupAuth', 'auth' => 'administratorsGroup']);
    Route::any('administrators/group/status', ['uses' => 'AdminsController@groupStatus', 'auth' => 'administratorsGroup']);


    /*
     * 管理员用户
     * */
    Route::get('administrators/user', ['uses' => 'AdminsController@userList', 'auth' => 'administratorsUser']);
    Route::any('administrators/user/add', ['uses' => 'AdminsController@userAdd', 'auth' => 'administratorsUser']);
    Route::any('administrators/user/edit/{id}', ['uses' => 'AdminsController@userEdit', 'auth' => 'administratorsUser']);
    Route::get('administrators/user/status', ['uses' => 'AdminsController@userSetStatus', 'auth' => 'administratorsUser']);
    Route::get('administrators/user/delete/{id}', ['uses' => 'AdminsController@userSetDelete', 'auth' => 'administratorsUser']);


    /*
     * 插件iframe
     * */
    Route::get('plugin/store', ['uses' => 'PluginController@iframeStore', 'auth' => 'plugin']);

    /*
     * 插件下载和解析
     * */
    Route::any('plugin/server/download', ['uses' => 'PluginController@serverDownload', 'auth' => 'plugin']);
//    /*
//     * 插件和系统下载中
//     * */
//    Route::get('download/server/loading', ['uses' => 'CommonController@downloadServerLoading', 'auth' => '']);

    /*
     * 主题iframe
     * */
    Route::get('theme/store', ['uses' => 'ThemeController@iframeStore', 'auth' => 'settingTheme']);


    /*
     * 主题下载和解析
     * */
    Route::any('theme/server/download', ['uses' => 'ThemeController@serverDownload', 'auth' => 'settingTheme']);

    /*
     *测试
     * */
    Route::any('test/test', 'IndexController@test');

});




























