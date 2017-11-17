<?php
/**
 * Created by PhpStorm.
 * User: LONG JIN WEN
 * Date: 2017/6/28
 * Time: 17:45
 */

namespace App\Http\Model\Home;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model {
    public $table="menu_home";

    public static function sortMenu($data, $pid = 0, $level = 0) {
        static $sortHomeMenu = [];
        foreach ($data as $k => $v) {
            if ($v['p_id'] == $pid) {
                $v['level'] = $level;
                $sortHomeMenu[] = $v;
                Menu::sortMenu($data, $v['id'], $level + 1);
            }
        }
        return $sortHomeMenu;
    }

}

