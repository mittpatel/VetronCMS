<?php
/**
 * Created by PhpStorm.
 * User: LONG JIN WEN
 * Date: 2017/6/16
 * Time: 11:47
 */

namespace App\Http\Controllers\Admin;

use App\Http\Model\Admin\ArticleCategory;
use App\Http\Model\Admin\Article;
use App\Http\Model\Admin\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ArticleController extends CommonController {
    /*
     * 文章分类
     * */
    public function articleCategory() {
        session(['breadcrumb' => ['url' => 'article/category', 'modular' => admin_language('article_category'), 'action' => admin_language('common_lists')]]);
        $categoryList = ArticleCategory::sortCategory(ArticleCategory::orderBy('id', 'asc')->get(), 0, 0);
        return view('admin/article/articleCategory', compact('categoryList'), ['other' => ['navActive' => 'article', 'navActiveSon' => 'articleCategory']]);
    }

    /*
     * 分类添加
     * */
    public function articleCategoryAdd(Request $request) {
        if ($request->isMethod('get')) {
            $language = Language::where('modular', 1)->get();
            session(['breadcrumb' => ['url' => 'article/category', 'modular' => admin_language('article_category'), 'action' => admin_language('common_add')]]);
            $categoryList = ArticleCategory::sortCategory(ArticleCategory::all(), 0, 0);
            return view('admin/article/articleCategoryAdd', compact('categoryList', 'language'), ['other' => ['navActive' => 'article', 'navActiveSon' => 'articleCategory']]);

        }
        if ($request->isMethod('post')) {
            $post = $request->all();
            if (!$post['language_key']) {
                exit(json_encode(['status' => 50, 'msg' => admin_language('verification_Name')]));
            }
            if (ArticleCategory::create($request->all())) {
                //将语言添加入语言包
                foreach ($request->lang as $k => $l) {
                    if (!empty($l)) {
                        $this->addLangData($k, [$request->language_key => $l], 1);
                    }
                }
                exit(json_encode(['status' => 1, 'msg' => admin_language('common_addSuccess'), 'url' => url('admin/article/category')]));
            } else {
                exit(json_encode(['status' => 50, 'msg' => admin_language('common_addFailed')]));
            }

        }
    }

    /*
     * 分类删除
     * */
    public function articleCategoryDelete($id) {
        if (ArticleCategory::where(['pid' => $id])->first()) {
            session_tips(admin_language('common_forbiddenToDelete'));
        } else {
            if (ArticleCategory::destroy($id)) session_tips(admin_language('common_deleteSuccess'));
            else session_tips(admin_language('common_deleteFailed'));
        }

        return back();
    }

    /*
     * 分类编辑
     * */
    public function articleCategoryEdit(Request $request, $id) {
        if ($request->isMethod('get')) {
            session(['breadcrumb' => ['url' => 'article/category', 'modular' => admin_language('article_category'), 'action' => admin_language('common_edit')]]);

            $categoryList = ArticleCategory::sortCategory(ArticleCategory::all(), 0, 0);
            $categoryOne = ArticleCategory::find($id);
            $isLastSonCategory = !ArticleCategory::where(['pid' => $id])->first();
            $language = Language::where('modular', 1)->get();
            return view('admin/article/articleCategoryEdit', compact('language', 'categoryList', 'categoryOne', 'isLastSonCategory'), ['other' => ['navActive' => 'article', 'navActiveSon' => 'articleCategory']]);
        }
        if ($request->isMethod('post')) {
            $post = $request->all();
            $data = ArticleCategory::find($post['id']);

            $data->language_key = $post['language_key'];
            $data->pid = $post['pid'];
            $data->note = $post['note'];
            $data->note = $post['note'];
            $data->status = $post['status'];

            $data->save();
            //将语言添加入语言包
            foreach ($request->lang as $k => $l) {
                if (!empty($l)) {
                    $this->addLangData($k, [$request->language_key => $l], 1);
                }
            }
            exit(json_encode(['status' => 1, 'msg' => admin_language('common_updateSuccess'), 'url' => url('admin/article/category')]));


        }

    }

    /*
     * 文章列表所有
     * */
    public function articleList() {
        session(['breadcrumb' => ['url' => 'article/category', 'modular' => admin_language('common_article'), 'action' => admin_language('common_lists')]]);
        $articleList = Article::orderBy('id', 'desc')->get();
        return view('admin/article/articleList', compact('articleList'), ['other' => ['navActive' => 'article', 'navActiveSon' => 'article']]);

    }

    /*
     * 文章添加
     * */
    public function articleAdd(Request $request) {
        if ($request->isMethod('get')) {
            session(['breadcrumb' => ['url' => 'article', 'modular' => admin_language('common_article'), 'action' => admin_language('common_add')]]);
            //$categoryList = ArticleCategory::sortTreeCategory(ArticleCategory::orderBy('id', 'asc')->select('id', 'language_key as text', 'pid', 'language_key as href')->get(), 0);

            $articleCategoryList = ArticleCategory::sortCategory(ArticleCategory::orderBy('id', 'asc')->get(), 0, 0);
            //判断是否存在下级分类
            foreach ($articleCategoryList as $key => $categoryListVal) {
                $articleCategoryList[$key]->isTop = ArticleCategory::where(['pid' => $categoryListVal->id])->value('id') ? 1 : 2;
            }


            return view('admin/article/articleAdd', compact('articleCategoryList'), ['other' => ['navActive' => 'article', 'navActiveSon' => 'article']]);
        }
        if ($request->isMethod('post')) {

            $post = $this->getRequestData('post', ['_token']);

            $tips = [
                'title' => admin_language('verification_Title'),
                'content' => admin_language('verification_Content'),
            ];
            if (!isset($_POST['category'])) {
                session_tips(admin_language('verification_Category'));
                return back();
            }
            if ($_FILES['cover']['size'][0] == 0) {
                session_tips(admin_language('verification_Cover'));
                return back();
            }
            $upload = $this->upLoads('cover', 'article');

            if ($this->verificationNull($post, $tips)) {
                $insert = [
                    'cover' => implode(',', $upload),
                    'title' => $post['title'],
                    'category' => implode(',', $_POST['category']),
                    'content' => $_POST['content'],
                    'seo' => json_encode($_POST['seo'])
                ];
                $a = Article::create($insert);
                $this->updateTitleIndex($a->id);
                if ($a) {
                    session_tips(admin_language('common_addSuccess'));
                    return redirect('admin/article');
                } else {
                    session_tips(admin_language('common_addFailed'));
                    return back();
                }

            } else {
                return back();
            }


        }


    }

    /*
     * 文章编辑
     * */
    public function articleEdit(Request $request, $id) {
        if ($request->isMethod('get')) {
            session(['breadcrumb' => ['url' => 'article', 'modular' => admin_language('common_article'), 'action' => admin_language('common_edit')]]);
            $data = Article::findOrfail($id);

            $articleCategoryList = ArticleCategory::sortCategory(ArticleCategory::orderBy('id', 'asc')->get(), 0, 0);
            //判断是否存在下级分类
            foreach ($articleCategoryList as $key => $categoryListVal) {
                $articleCategoryList[$key]->isTop = ArticleCategory::where(['pid' => $categoryListVal->id])->value('id') ? 1 : 2;
            }
            return view('admin/article/articleEdit', compact('articleCategoryList', 'data'), ['other' => ['navActive' => 'article', 'navActiveSon' => 'article']]);

        }


        if ($request->isMethod('post')) {
            $post = $this->getRequestData('post', ['_token']);

            $tips = [
                'title' => admin_language('verification_Title'),
                'content' => admin_language('verification_Content'),
            ];
            if (!$request->has('category')) {
                session_tips(admin_language('verification_Category'));
                return back();
            }

            $upload = $this->upLoads('cover', 'article');

            if (!$_POST['oldCover']) $_POST['oldCover'] = [];

            if ($upload) {
                $cover = array_merge($upload, $_POST['oldCover']);
            } else {
                $cover = $_POST['oldCover'];
            }


            if ($this->verificationNull($post, $tips)) {
                $insert = [
                    'cover' => trim(implode(',', $cover), ','),
                    'title' => $post['title'],
                    'category' => implode(',', $_POST['category']),
                    'content' => $_POST['content'],
                    'seo' => json_encode($_POST['seo'])
                ];

                if (Article::where(['id' => $_POST['id']])->update($insert)) {
                    $this->updateTitleIndex($_POST['id']);
                    session_tips(admin_language('common_updateSuccess'));
                    return redirect('admin/article');
                } else {
                    session_tips(admin_language('common_updateFailed'));
                    return back();
                }

            } else {
                return back();
            }


        }
    }

    /*
     * 文章删除
     * */

    public function articleDelete($id) {
        if (Article::destroy($id)) session_tips(admin_language('common_deleteSuccess'));
        else session_tips(admin_language('common_deleteFailed'));
        return back();

    }

    /*
     * 更新文章标题索引
     * */
    private function updateTitleIndex($id) {
        $article = Article::find($id);
        $article->title_index = preg_replace("/[\s]+/is", "-", $article->title);
        $article->save();
    }

}