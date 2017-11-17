<?php
/**
 * Created by PhpStorm.
 * User: LONG JIN WEN
 * Date: 2017/8/14
 * Time: 14:39
 */

namespace App\Http\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class HomeHistory extends Model {


    protected $table = 'home_history';

    public $timestamps = false;
    protected $primaryKey = 'id';



}