<?php
/**
 * Created by PhpStorm.
 * User: LONG JIN WEN
 * Date: 2017/6/16
 * Time: 10:10
 */

namespace App\Http\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class AdminUser extends Model {


    protected $table = 'admin_user';


    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $guarded = ['_token','id'];

}