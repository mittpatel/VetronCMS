<?php
/**
 * Created by PhpStorm.
 * User: LONG JIN WEN
 * Date: 2017/9/22
 * Time: 18:33
 */
namespace App\Http\Model\Admin;

use Illuminate\Database\Eloquent\Model;


class ProductAttributeType extends Model{
    protected $table = 'product_attribute_type';

    protected $primaryKey = 'id';
    protected $guarded = ['_token', 'id'];
    public $timestamps = false;

}
