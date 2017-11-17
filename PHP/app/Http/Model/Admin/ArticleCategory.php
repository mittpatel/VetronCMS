<?php
/**
 * Created by PhpStorm.
 * User: LONG JIN WEN
 * Date: 2017/6/16
 * Time: 11:50
 */

namespace App\Http\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class ArticleCategory extends Model {


    protected $table = 'article_category';

//    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $guarded = ['_token', 'id','lang'];

    /*
    const DELETED_AT='delete_at';
    const UPDATED_AT='update_at';
    const CREATED_AT = 'create_at';
    */
    //将分类排序

    private static $sortCategory = [];

    public static function sortCategory($data, $pid = 0, $level = 1) {
        foreach ($data as $k => $v) {
            if ($v['pid'] == $pid) {
                $v['level'] = $level;
                self::$sortCategory[] = $v;
                ArticleCategory::sortCategory($data, $v['id'], $level + 1);
            }
        }
        return self::$sortCategory;
    }


    //  将分类排序,将子类放置子对象中
    public static function sortTreeCategory($data, $pid = 0, $checkedId) {
//        dd(in_array("27", $checkedId));
        $tree = [];

        foreach ($data as $k=>$v) {
            if ($v['pid'] == $pid) {
                $v['nodes'] = ArticleCategory::sortTreeCategory($data, $v['id'],$checkedId);
                $state = [];
                if (in_array("$v->id", $checkedId)) {
                    $state['checked'] = true;
                    $state['expanded'] = true;
                } else {
                    $state['expanded'] = false;
                }
                if ($v['nodes'] == null) {
                    unset($v['nodes']);
                }else{
//                    如果没有子节点
//                    $state['checked'] = true;
//                    $v['showCheckbox']=true;
                    $v['aaaaaaaaaaa']=111111111;

                }
                $v->state = $state;
                $tree[] = $v;
            }
        }
        return $tree;
    }


}