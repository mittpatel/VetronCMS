<?php
/**
 * Created by PhpStorm.
 * User: LONG JIN WEN
 * Date: 2017/6/5
 * Time: 11:57
 */
function app_public() {
    return asset('/');
}

function html_special_chars($data) {
    foreach ($data as $key => $value) {
        $data[$key] = trim(htmlspecialchars($value));
    }
    return $data;
}

//后台多语言
function admin_language($key) {

    if (trans('adminLanguage.' . $key) == 'adminLanguage.' . $key) {
        return trans('adminLanguage.' . $key, '', '', env('ADMIN_LOCALE'));
    }
    return trans('adminLanguage.' . $key);
}

//前台多语言
function home_language($key) {
    if (trans('homeLanguage.' . $key) == 'homeLanguage.' . $key) {
        return trans('homeLanguage.' . $key, '', '', env('HOME_LOCALE'));
    }
    return trans('homeLanguage.' . $key);
}

//多语言统一方法
function language_all($key, $m, $lang) {
    if ($m == 'home') {
        $l = 'homeLanguage';
    } else {
        $l = 'adminLanguage';
    }
    if (trans($l . '.' . $key, '', '', $lang) == $l . '.' . $key) {
        return trans($l . '.' . $key, '', '', $lang);
    }
    return trans($l.'.' . $key,'','',$lang);
}

function getArticleCategoryName($categoryId){
    $name='';
    foreach (explode(',',$categoryId) as $value){
        $name.=','.home_language(\App\Http\Model\Admin\ArticleCategory::where('id',$value)->value('language_key'));
    }
    return trim($name,',');

}
function getProductCategoryName($categoryId){
    $name='';
    foreach (explode(',',$categoryId) as $value){
        $name.=','.home_language(\App\Http\Model\Admin\ProductCategory::where('id',$value)->value('language_key'));
    }
    return trim($name,',');

}
function session_form_old($field) {
    $data = session()->pull('request_data');
    $re = $data[$field];
    unset($data[$field]);
    session()->put(['request_data' => $data]);
    return $re;
}

function session_tips($str) {
    session()->put(['tips' => $str]);
}

//获取根据规律的字符串最后一个
function getFormArrLastStr($str, $separator) {
    $newArr = explode($separator, $str);
    return $newArr[count($newArr) - 1];
}

//判断字符串的后缀
function isAllowSuffix($str, $allowArr) {
    $newArr = explode('.', $str);
    if (in_array($newArr[count($newArr) - 1], $allowArr)) return true;
    return false;
}


function removePublic($str) {
    return explode(public_path(), $str)[1];
}

//
function getUpPath($str, $s = '/') {

    $arr = explode($s, $str);
    $mun = count($arr);
    $ret_str = '';
    foreach ($arr as $k => $v) {
        if ($mun - 1 != $k) {
            $ret_str .= $v . $s;
        }
    }
    return trim($ret_str, $s);
}

function removeUploadStr($str) {

    return explode('/uploads/', $str)[1];
}

function cut($background, $cut_x, $cut_y, $cut_width, $cut_height, $location) {
    $back = imagecreatefromjpeg($background);
    $new = imagecreatetruecolor($cut_width, $cut_height);
    imagecopyresampled($new, $back, 0, 0, $cut_x, $cut_y, $cut_width, $cut_height, $cut_width, $cut_height);
    imagejpeg($new, $location);
    imagedestroy($new);
    imagedestroy($back);
}

function productCategoryStrInObjArr($objArr, $str) {
    foreach ($objArr as $value) {
        if ($value->pid == $str) return true;
        continue;
    }
}

/*
function hook($class, $method, $parameter = []) {

    \Hook::run($class, $method, $parameter);
}*/

function hook_lang($key = null) {
    /*
    if (!$key) return null;
    $now = session('locale');

    $langList = \App\Plugins\PluginsController::$language;
    if (in_array($now, $langList)) $lang = $now;
    else $lang = $langList[0];

    $data = require \App\Plugins\PluginsController::$root . '/lang/' . $lang . '.php';

    return $data[$key];
    */

}

/*
 * 获取纯文本
 * */
function pure_text($string, $sub_len) {

    $string = strip_tags($string);

    $string = preg_replace('/\n/is', '', $string);

    $string = preg_replace('/ |　/is', '', $string);

    $string = preg_replace('/&nbsp;/is', '', $string);

    preg_match_all("/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/", $string, $t_string);

    if (count($t_string[0]) - 0 > $sub_len) $string = join('', array_slice($t_string[0], 0, $sub_len)) . "…";

    else $string = join('', array_slice($t_string[0], 0, $sub_len));

    return $string;

}

//修改.env文件
function modifyEnv($data) {
    $envPath = base_path() . '/.env';
    $str = '';
    foreach (file($envPath) as $key => $value) {
        $t = explode('=', $value);
        if (empty(trim($value))) continue;
        $new[trim($t[0])] = trim($t[1]);
        foreach ($data as $k => $v) {
            if (trim($t[0]) == trim($k)) {
                $new[$t[0]] = trim($v);
            }
        }
    }
    foreach ($new as $k => $v) {
        $str .= $k . "=" . $v . "\r\n";
    }
    return file_put_contents($envPath, $str);
}

//判断字符串是否以https:和https:开头
function ifHttpHttps($str) {
    if (preg_match("/^(http:\/\/|https:\/\/).*$/", $str)) {
        return true;
    }
    return false;
}


if (! function_exists('get_base_url')) {

    function get_base_url()
    {
        $base_url  = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') ? "https://" : "http://";
        $base_url .= $_SERVER["SERVER_NAME"];
        $base_url .= ($_SERVER["SERVER_PORT"] == "80") ? "" : (":".$_SERVER["SERVER_PORT"]);

        return $base_url;
    }
}

if (! function_exists('get_current_url')) {

    function get_current_url()
    {
        return get_base_url().$_SERVER["REQUEST_URI"];
    }
}








