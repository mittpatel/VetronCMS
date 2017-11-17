<?php
/**
 * Created by PhpStorm.
 * User: LONG JIN WEN
 * Date: 2017/7/21
 * Time: 10:03
 */


use Illuminate\Support\Facades\DB;

/*
 * 获取所有文章
 * @param integer $pageNum 分页数
 * @return object
 */
function getArticleAll($pageNum = null) {
    if ($pageNum) {
        $ArticleAll = DB::table('article')->orderBy('id', 'desc')->paginate($pageNum);
    } else {
        $ArticleAll = DB::table('article')->orderBy('id', 'desc')->get();
    }
    return $ArticleAll;

}


/*
 * 文章类别下文章
 * @param integer $categoryId 文章类别id
 * @param integer $pageNum 分页数
 * @return object
 * */
function getArticleFromCategory($categoryId, $pageNum = null) {
    if ($pageNum) {
        $Article = \App\Http\Model\Home\Article::whereRaw("FIND_IN_SET(?,category)", $categoryId)->orderBy('id', 'desc')->paginate($pageNum);
    } else {
        $Article = \App\Http\Model\Home\Article::whereRaw("FIND_IN_SET(?,category)", $categoryId)->orderBy('id', 'desc')->get();
    }
    foreach ($Article as &$a) {
        switch (ARTICLE_URL_MODEL) {
            case 1:
                $a->url = url('details/' . $a->id);
                break;
            case 2:
                $a->url = url('details/' . date('Y-m-d', strtotime($a->created_at)) . '/' . $a->id);
                break;
            case 3:
                $a->url = url('details/' . date('Y/m/d', strtotime($a->created_at)) . '/' . $a->id);
                break;
            case 4:
                $a->url = url('details?title=' . $a->title_index);
                break;
        }
    }
    return $Article;
}

/*
 * 获取一个文章详情
 * @param integer $id 文章id
 * @return object
 * */
function getArticleDetails($par1 = null, $par2 = null, $par3 = null, $par4 = null) {


    switch (ARTICLE_URL_MODEL) {
        case 1:
            $data = \App\Http\Model\Home\Article::findOrFail($par1);
            break;
        case 2:
            $data = \App\Http\Model\Home\Article::findOrFail($par2);
            break;
        case 3:
            $data = \App\Http\Model\Home\Article::findOrFail($par4);
            break;
        case 4:
            $data = \App\Http\Model\Home\Article::where('title_index', $_GET['title'])->first();
            break;
    }


    $data->cover = explode(',', $data->cover);
    $data->seo = json_decode($data->seo, true);
    return $data;
}


/*
 * 获取所有产品
 * @param integer $pageNum 分页数
 * @return object
 * */
function getProductAll($pageNum = null) {
    if ($pageNum) {
        $productAll = DB::table('product')->orderBy('id', 'desc')->paginate($pageNum);

    } else {
        $productAll = DB::table('product')->orderBy('id', 'desc')->get();
    }
    return $productAll;

}

/*
 * 产品分类下的产品
 * @param integer $categoryId 文章类别id
 * @param integer $pageNum 分页数
 * @param boolean $attribute 是否获取属性
 * @return object
 * */
function getProductFromCategory($categoryId, $pageNum = null, $attribute = false) {
    if ($pageNum) {
        $product = DB::table('product')->where('category', $categoryId)->orderBy('id', 'desc')->paginate($pageNum);
    } else {
        $product = DB::table('product')->where('category', $categoryId)->orderBy('id', 'desc')->get();
    }
    if (!$attribute)
        return $product;
    foreach ($product as &$value) {
        $value->attribute = DB::table('product_attribute')
            ->leftJoin('product_attribute_value', 'product_attribute.id', '=', 'product_attribute_value.attribute_id')
            ->where('product_attribute_value.product_id', $value->id)
            ->select('product_attribute_value.attribute_value', 'product_attribute.name')
            ->pluck('attribute_value', 'name');
    }
    return $product;
}


/*
 * 获取一个产品的详情
 * @param integer $id 产品id
 * @param boolean $nextAndPrev 是否获取上一个和下一个
 * @return object
 * */
function getProductDetails($id, $nextAndPrev = false) {
    $data = DB::table('product')->where('id', $id)->first();
    $data->attribute = DB::table('product_attribute')
        ->leftJoin('product_attribute_value', 'product_attribute.id', '=', 'product_attribute_value.attribute_id')
        ->where('product_attribute_value.product_id', $data->id)
        ->select('product_attribute_value.attribute_value', 'product_attribute.name')
        ->pluck('attribute_value', 'name');
    $data->cover = explode(',', $data->cover);
    $data->seo = json_decode($data->seo, true);
    if (!$nextAndPrev) return $data;
    $data->nextAndPrev['prev'] = DB::table('product')->where('id', '<', $id)->where('category', $data->category)->first();
    $data->nextAndPrev['next'] = DB::table('product')->where('id', '>', $id)->where('category', $data->category)->first();
    return $data;
}


/*
 * 获取分类下面所有子分类
 * @param array $categoryData 分类数据
 * @param integer $pid 父分类id
 * */
function getCategorySonIdFromParentId($categoryData, $pid = null) {
    static $CategorySonIdArray = [];
    foreach ($categoryData as $key => $value) {
        if ($value->pid == $pid) {
            $CategorySonIdArray[] = $value->id;
            getCategorySonIdFromParentId($categoryData, $value->id);
        }
    }
    return array_merge($CategorySonIdArray, [intval($pid)]);
}










