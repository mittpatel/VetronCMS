<?php
/**
 * Created by PhpStorm.
 * User: LONG JIN WEN
 * Date: 2017/8/15
 * Time: 10:27
 */
namespace App\Http\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class PluginOptions extends Model {


    protected $table = 'plugin_options';

    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $guarded = ['_token', 'id'];

}