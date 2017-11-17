<?php
/**
 * Created by PhpStorm.
 * User: LONG JIN WEN
 * Date: 2017/6/16
 * Time: 16:26
 */

namespace App\Http\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Article extends Model {


    protected $table = 'article';

//    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $guarded = ['_token', 'id'];


}