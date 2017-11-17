<?php
/**
 * Created by PhpStorm.
 * User: LONG JIN WEN
 * Date: 2017/6/16
 * Time: 10:10
 *
 * 管理员登陆历史
 */

namespace App\Http\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class AdminHistory extends Model {

    protected $table = 'admin_history';

    public $timestamps = false;
    protected $primaryKey = 'id';
    //白名单
    protected $fillable = [];
    //黑名单
    protected $guarded = [];


}