<?php
/**
 * Created by PhpStorm.
 * User: LONG JIN WEN
 * Date: 2017/6/16
 * Time: 11:47
 */

namespace App\Http\Controllers\Admin;

use App\Http\Model\Admin\GalleryCategory;
use App\Http\Model\Admin\Gallery;
use App\Http\Model\Admin\Language;
use Illuminate\Http\Request;


class GalleryController extends CommonController {
    /*
     * 相册分类
     * */
    public function galleryCategory(Request $request) {
        session(['breadcrumb' => ['url' => 'gallery/category', 'modular' => admin_language('gallery_gallery'), 'action' => admin_language('common_category')]]);
//        $categoryList = GalleryCategory::sortCategory(GalleryCategory::orderBy('id', 'asc')->get(), 0, 0);
        $pid = $request->has('p') ? $request->p : 0;

        $categoryList = GalleryCategory::where(['pid' => $pid])->get();
//        $ppid=GalleryCategory::where()->value('');
        $ppId = GalleryCategory::where(['id' => $pid])->value('pid');
//        判断是否存在下级
        foreach ($categoryList as $k => $value) {
            $categoryList[$k]->isTop = GalleryCategory::where(['pid' => $value->id])->value('id') ? 1 : 2;
        }

        return view('admin/gallery/galleryCategory', compact('categoryList', 'pid', 'ppId'), ['other' => ['navActive' => 'gallery', 'navActiveSon' => 'galleryCategory']]);
    }


    /*
     * 分类添加
     * */
    public function galleryCategoryAdd(Request $request) {
        if ($request->isMethod('get')) {
            session(['breadcrumb' => ['url' => 'gallery/category', 'modular' => admin_language('common_category'), 'action' => admin_language('common_add')]]);
            $categoryList = GalleryCategory::sortCategory(GalleryCategory::all(), 0, 0);
            $language = Language::where('modular', 1)->get();

            return view('admin/gallery/galleryCategoryAdd', compact('categoryList', 'language'), ['other' => ['navActive' => 'gallery', 'navActiveSon' => 'galleryCategory']]);


        }
        if ($request->isMethod('post')) {
            $post = $request->all();
            if (!$post['language_key']) {
                exit(json_encode(['status' => 50, 'msg' => admin_language('verification_Name')]));
            }
            if (GalleryCategory::create($request->all())) {
                //将语言添加入语言包
                foreach ($request->lang as $k => $l) {
                    if (!empty($l)) {
                        $this->addLangData($k, [$request->language_key => $l], 1);
                    }
                }
                exit(json_encode(['status' => 1, 'msg' => admin_language('common_addSuccess'), 'url' => url('admin/gallery/category')]));
            } else {
                exit(json_encode(['status' => 50, 'msg' => admin_language('common_addFailed')]));
            }
        }
    }

    /*
     * 分类删除
     * */
    public function galleryCategoryDelete($id) {
        if (GalleryCategory::where(['pid' => $id])->first()) {
            session_tips(admin_language('common_forbiddenToDelete'));
        } else {
            if (GalleryCategory::destroy($id)) session_tips(admin_language('common_deleteSuccess'));
            else session_tips(admin_language('common_deleteFailed'));
        }

        return back();
    }

    /*
     * 分类编辑
     * */
    public function galleryCategoryEdit(Request $request, $id) {
        if ($request->isMethod('get')) {
            session(['breadcrumb' => ['url' => 'gallery/category', 'modular' => admin_language('common_category'), 'action' => admin_language('common_edit')]]);
            $categoryList = GalleryCategory::sortCategory(GalleryCategory::all(), 0, 0);
            $categoryOne = GalleryCategory::find($id);
            $isLastSonCategory = !GalleryCategory::where(['pid' => $id])->first();
            $language = Language::where('modular', 1)->get();
            return view('admin/gallery/galleryCategoryEdit', compact('language', 'categoryList', 'categoryOne', 'isLastSonCategory'), ['other' => ['navActive' => 'gallery', 'navActiveSon' => 'galleryCategory']]);
        }
        if ($request->isMethod('post')) {
            $post = $request->all();
            $data = GalleryCategory::find($post['id']);

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
            exit(json_encode(['status' => 1, 'msg' => admin_language('common_updateSuccess'), 'url' => url('admin/gallery/category')]));


        }

    }

    /*
     * ajax上传分类封面
     * */
    public function ajaxUploadGalleryCategory() {
        $upload = $this->upLoads('cover', 'gallery');
        if ($upload) {
            exit(json_encode(['status' => 1, 'path' => $upload[0], 'url' => asset($upload[0])]));
        } else
            exit(json_encode(['status' => 50, 'msg' => admin_language('common_uploadFailed')]));

    }

    /*
     * 相册列表
     * */
    public function galleryList(Request $request) {
        $pid = $request->has('c') ? $request->c : null;
        session(['breadcrumb' => ['url' => 'gallery', 'modular' => admin_language('gallery_gallery'), 'action' => admin_language('common_lists')]]);
        $categoryList = GalleryCategory::sortCategory(GalleryCategory::orderBy('id', 'asc')->get(), 0, 0);
        //判断是否存在下级分类
        foreach ($categoryList as $key => $categoryListVal) {
            $categoryList[$key]->isTop = GalleryCategory::where(['pid' => $categoryListVal->id])->value('id') ? 1 : 2;
        }
//
        if ($pid) {
            $where = ['category_id' => $pid];
        } else {
            $where = [];
        }
        $galleryList = Gallery::where($where)->get();

        return view('admin/gallery/galleryList', compact('categoryList', 'galleryList'), ['other' => ['navActive' => 'gallery', 'navActiveSon' => 'gallery']]);

    }

    /*
     * ajax获取相册
     * */
    public function ajaxGetGallery() {
        $galleryList = Gallery::where(['category_id' => $_GET['id']])->get();
//        if (count($galleryList)!=0){
        return view('admin/gallery/ajax/ajaxGetGallery', compact('galleryList'));

//        }
    }

    /*
     * 相册删除
     * */
    public function galleryDelete($id) {
        if (Gallery::destroy($id)) return back()->with('tips', admin_language('common_deleteSuccess'));
        else return back()->with('tips', admin_language('common_deleteFailed'));
    }

    /*
     * 相册添加
     * */
    public function galleryAdd(Request $request, $id) {
        if ($request->isMethod('get')) {
            session(['breadcrumb' => ['url' => 'gallery', 'modular' => admin_language('gallery_gallery'), 'action' => admin_language('common_add')]]);
            $categoryList = GalleryCategory::sortCategory(GalleryCategory::orderBy('id', 'asc')->get(), 0, 0);
            //判断是否存在下级分类
            foreach ($categoryList as $key => $categoryListVal) {
                $categoryList[$key]->isTop = GalleryCategory::where(['pid' => $categoryListVal->id])->value('id') ? 1 : 2;
            }
            return view('admin/gallery/galleryAdd', compact('categoryList', 'galleryList'), ['other' => ['navActive' => 'gallery', 'navActiveSon' => 'gallery']]);

        }
        if ($request->isMethod('post')) {
            if (Gallery::create($request->all())) {
                exit(json_encode(['status' => 1, 'msg' => admin_language('common_addSuccess'), 'url' => url('admin/gallery') . '?c=' . $request->category_id]));
            } else {
                exit(json_encode(['status' => 50, 'msg' => admin_language('common_addFailed')]));
            }
        }
    }

    /*
     * ajax上传相册
     * */
    public function ajaxUploadGallery() {
        $upload = $this->upLoads('cover', 'gallery');
        if ($upload) {
            exit(json_encode(['status' => 1, 'path' => $upload[0], 'url' => asset($upload[0])]));
        } else
            exit(json_encode(['status' => 50, 'msg' => admin_language('common_uploadFailed')]));
    }


}