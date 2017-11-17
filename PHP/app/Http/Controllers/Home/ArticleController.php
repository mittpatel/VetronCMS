<?php

/**
 * Created by PhpStorm.
 * User: LONG JIN WEN
 * Date: 2017/7/6
 * Time: 18:19
 */

namespace App\Http\Controllers\Home;

use App\Http\Model\Home\Article;
use Illuminate\Support\Facades\DB;

class ArticleController extends CommonController {


    /*
     * 文章类别
     * */
    public function articleCategory($categoryId) {
        $data = getArticleFromCategory($categoryId);
        dd($data);
    }


    public function details($par1, $par2, $par3, $par4) {

        $aa = getArticleDetails($par1, $par2, $par3, $par4);
        dd($aa);

    }

}