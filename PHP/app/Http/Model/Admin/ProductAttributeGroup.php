<?php
/**
 * Created by PhpStorm.
 * User: LONG JIN WEN
 * Date: 2017/6/21
 * Time: 16:52
 */
namespace App\Http\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class ProductAttributeGroup extends Model {
    protected $table = 'product_attribute_group';

    protected $primaryKey = 'id';
    protected $guarded = ['_token', 'id'];
    public $timestamps = false;

}