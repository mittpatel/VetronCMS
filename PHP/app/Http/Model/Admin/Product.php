<?php
/**
 * Created by PhpStorm.
 * User: LONG JIN WEN
 * Date: 2017/6/20
 * Time: 10:25
 */
namespace App\Http\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Product extends Model {
    protected $table = 'product';

    protected $primaryKey = 'id';
    protected $guarded = ['_token', 'id'];


}