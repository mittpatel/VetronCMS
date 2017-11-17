<?php
/**
 * Created by PhpStorm.
 * User: LONG JIN WEN
 * Date: 2017/6/19
 * Time: 15:42
 */

namespace App\Http\Model\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProductCategory extends Model {
    protected $table = 'product_category';

    protected $primaryKey = 'id';
    protected $guarded = ['_token', 'id','lang'];

    private static $sortCategory = [];

    public static function sortCategory($data, $pid = 0, $level = 1) {
        foreach ($data as $k => $v) {
            if ($v['pid'] == $pid) {
                $v['level'] = $level;
                self::$sortCategory[] = $v;
                ProductCategory::sortCategory($data, $v['id'], $level + 1);
            }
        }
        return self::$sortCategory;
    }


    /*
     * 将分类排序,将子类放置子对象中
     * */
    public static function sortTreeCategory($data, $pid = 0, $checkedId) {
        $tree = [];
        foreach ($data as $v) {
            if ($v['pid'] == $pid) {
                $v['nodes'] = ProductCategory::sortTreeCategory($data, $v['id'], $checkedId);
                if (in_array("$v->id", $checkedId)) {
                    $state = [];
                    $state['checked'] = true;
                    $state['expanded'] = true;
                    $v->state = $state;
                } else {
                    $state = [];
                    $state['expanded'] = false;
                    $v->state = $state;
                }
                if ($v['nodes'] == null) {
                    unset($v['nodes']);
                }
                $tree[] = $v;
            }
        }
        return $tree;
    }

    /*
     * 所有分类与属性关联的数据
     * */
    public static function getAttributeFormCategory() {


//        foreach ($attribute as $value){
//            $attribute->
//        }


//        return $this->hasMany('\App\Http\Model\Admin\ProductAttribute','category_id','id');

    }


}