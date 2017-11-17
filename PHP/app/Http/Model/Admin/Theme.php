<?php
/**
 * Created by PhpStorm.
 * User: LONG JIN WEN
 * Date: 2017/6/16
 * Time: 10:40
 */
namespace App\Http\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Theme extends Model {

    protected $table = 'theme';

    public $timestamps = false;

    protected $primaryKey = 'id';
    //白名单
    protected $fillable = [];
    //黑名单
    protected $guarded = [];


}