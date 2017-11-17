<?php
/**
 * Created by PhpStorm.
 * User: LONG JIN WEN
 * Date: 2017/6/29
 * Time: 9:59
 */

namespace App\Http\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class AdminGroup extends Model {
    public $table = 'admin_group';
    protected $guarded = ['_token', 'id','lang'];

    public static function sortAdminGroup($data, $pid = 0, $level = 0) {
        static $sortAdminGroup = [];
        foreach ($data as $k => $v) {
            if ($v['p_id'] == $pid) {
                $v['level'] = $level;
                $sortAdminGroup[] = $v;
                AdminGroup::sortAdminGroup($data, $v['id'], $level + 1);
            }
        }
        return $sortAdminGroup;
    }
    /*
     * 排序树升级版，$onlyId解决循环调用后返回数据叠加的问题
     * */
    public static function treeAdminGroup($data, $onlyId, $pid = 0, $level = 0) {
        static $sortAdminGroup;
        foreach ($data as $v) {
            if ($v['p_id'] == $pid) {
                $v['level'] = $level;
                $sortAdminGroup[$onlyId][] = $v;
                AdminGroup::treeAdminGroup($data, $onlyId, $v['id'], $level + 1);
            }
        }
        return $sortAdminGroup[$onlyId];
    }


}