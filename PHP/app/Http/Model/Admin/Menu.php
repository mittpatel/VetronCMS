<?php
/**
 * Created by PhpStorm.
 * User: LONG JIN WEN
 * Date: 2017/6/16
 * Time: 11:15
 */
namespace App\Http\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model {

    protected $table = 'menu_admin';

    public $timestamps = false;

    protected $primaryKey = 'id';
    //白名单
    protected $fillable = [];
    //黑名单
    protected $guarded = ['_token'];


}