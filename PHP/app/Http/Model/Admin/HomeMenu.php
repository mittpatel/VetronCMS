<?php
/**
 * Created by PhpStorm.
 * User: LONG JIN WEN
 * Date: 2017/6/16
 * Time: 11:15
 */
namespace App\Http\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class HomeMenu extends Model {

    protected $table = 'menu_home';


    protected $primaryKey = 'id';
    //白名单
    protected $fillable = [];
    //黑名单
    protected $guarded = ['_token','lang'];

    /*
     *将列表进行排序，从父级开始往下排序
     * @data数据
     * @pid起始父id
     * @level排序后起始的偏移量
     * */

    public static function sortHomeMenu($data, $pid = 0, $level = 0) {
        static $sortHomeMenu = [];
        foreach ($data as $k => $v) {
            //p_id 父级id字段
            if ($v['p_id'] == $pid) {
                $v['level'] = $level;
                $sortHomeMenu[] = $v;
                //id 主id
                HomeMenu::sortHomeMenu($data, $v['id'], $level + 1);
            }
        }
        return $sortHomeMenu;
    }

}