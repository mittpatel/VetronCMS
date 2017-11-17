<?php
/**
 * Created by PhpStorm.
 * User: LONG JIN WEN
 * Date: 2017/6/19
 * Time: 15:29
 */

namespace App\Http\Controllers\Admin;

use App\Http\Model\Admin\Language;
use App\Http\Model\Admin\ProductAttributeType;
use App\Http\Model\Admin\ProductAttributeGroup;

use Illuminate\Http\Request;
use App\Http\Model\Admin\ProductCategory;
use App\Http\Model\Admin\Product;

use App\Http\Model\Admin\ProductAttributeValue;


class ProductController extends CommonController {

    protected static $parents;

    /*
    * 产品列表
    * */
    public function productList() {
        session(['breadcrumb' => ['url' => 'product', 'modular' => admin_language('common_product'), 'action' => admin_language('common_lists')]]);
        $productList = Product::all();
        return view('admin/product/productList', compact('productList'), ['other' => ['navActive' => 'product', 'navActiveSon' => 'product']]);

    }

    /*
     * 产品添加
     * */
    public function productAdd(Request $request) {
        if ($request->isMethod('get')) {
            session(['breadcrumb' => ['url' => 'product', 'modular' => admin_language('common_product'), 'action' => admin_language('common_add')]]);

            $productCategory = ProductCategory::sortCategory(ProductCategory::orderBy('id', 'asc')->get(), 0, 0);
            $attributeGroup = ProductAttributeGroup::all();
            $attributeType = ProductAttributeType::all();

            //判断是否存在下级分类
            foreach ($productCategory as $key => $categoryListVal) {
                $productCategory[$key]->isTop = ProductCategory::where(['pid' => $categoryListVal->id])->value('id') ? 1 : 2;
            }

            return view('admin/product/productAdd', compact('productCategory', 'attributeGroup', 'attributeType'), ['other' => ['navActive' => 'product', 'navActiveSon' => 'product']]);
        }
        if ($request->isMethod('post')) {

            $this->validate($request, [
                'name' => 'required',
                'price' => 'required',
                'content' => 'required',
                'category' => 'required',
            ], [
                'name.required' => admin_language('verification_Name'),
                'price.required' => admin_language('verification_Price'),
                'content.required' => admin_language('verification_Content'),
                'category.required' => admin_language('verification_Category'),
            ]);
            if (!$request->cover[0]) {
                session_tips(admin_language('verification_Cover'));
                return back();
            }
            $upload = $this->upLoads('cover', 'product');

            //循环获取所有父级分类
            foreach ($request->category as $c) {
                $this->getCategoryParents($c);
            }
            $insert = [
                'name' => $request->name,
                'price' => $request->price,
                'content' => $request->content,
                'describe' => $request->describe,
                'seo' => json_encode($request->seo),
                'cover' => implode(',', $upload),
                'gallery' => implode(',', $request->gallery),
                'category' => implode(',', $request->category),
                'category_parents'=>implode(',', self::$parents)
            ];
            $create = Product::create($insert);

//          循环整理即将插入属性值表的数据
            foreach ($request->attribute as $k => $a) {
                //判断是否复选框
                if (is_array($a)) {
                    ProductAttributeValue::create([
                        'product_id' => $create->id,
                        'attribute_id' => $k,
                        'attribute_value' => implode(',', $a)
                    ]);
                } else {
                    if ($a) {
                        ProductAttributeValue::create([
                            'product_id' => $create->id,
                            'attribute_id' => $k,
                            'attribute_value' => $a
                        ]);
                    }
                }
            }

            if ($create) {
                session_tips(admin_language('common_addSuccess'));
                return redirect('admin/product');
            } else {
                return back()->with('tips', admin_language('common_addFailed'));
            }
        }
    }

    /*
     * 产品编辑
     * */
    public function productEdit(Request $request, $id) {
        if ($request->isMethod('get')) {
            session(['breadcrumb' => ['url' => 'product', 'modular' => admin_language('common_product'), 'action' => admin_language('common_edit')]]);
            $productOne = Product::findOrFail($id);
            $productCategory = ProductCategory::sortCategory(ProductCategory::orderBy('id', 'asc')->get(), 0, 0);

            //判断是否存在下级分类
            foreach ($productCategory as $key => $categoryListVal) {
                $productCategory[$key]->isTop = ProductCategory::where(['pid' => $categoryListVal->id])->value('id') ? 1 : 2;
            }
//            dd($productOne);
            $attributeGroup = ProductAttributeGroup::all();
            $attributeType = ProductAttributeType::all();
            return view('admin/product/productEdit', compact('productOne', 'productCategory', 'attributeGroup', 'attributeType'), ['other' => ['navActive' => 'product', 'navActiveSon' => 'product']]);
        }
        if ($request->isMethod('post')) {

            $upload = $this->upLoads('cover', 'product');

            if (!$request->oldCover) $request->oldCover = [];

            if ($upload) {
                $cover = array_merge($upload, $request->oldCover);
            } else {
                $cover = $request->oldCover;
            }
            //循环获取所有父级分类
            foreach ($request->category as $c) {
                $this->getCategoryParents($c);
            }

            $productOne = Product::findOrFail($id);
            $productOne->name = $request->name;
            $productOne->price = $request->price;
            $productOne->content = $request->content;
            $productOne->describe = $request->describe;
            $productOne->cover = implode(',', $cover);
            $productOne->seo = json_encode($request->seo);
            $productOne->gallery = implode(',', $request->gallery);
            $productOne->category = implode(',', $request->category);
            $productOne->category_parents = implode(',', self::$parents);

            $productOne->save();
            ProductAttributeValue::where('product_id', $productOne->id)->delete();
            foreach ($request->attribute as $k => $a) {
                //判断是否复选框
                if (is_array($a)) {
                    ProductAttributeValue::create([
                        'product_id' => $productOne->id,
                        'attribute_id' => $k,
                        'attribute_value' => implode(',', $a)
                    ]);
                } else {
                    if ($a) {
                        ProductAttributeValue::create([
                            'product_id' => $productOne->id,
                            'attribute_id' => $k,
                            'attribute_value' => $a
                        ]);
                    }

                }
            }
            return back()->with('tips', admin_language('common_updateSuccess'));
        }
    }

    /*
     * 产品删除
     * */
    public function productDelete($id) {
        if (Product::destroy($id)) {
            session_tips(admin_language('common_deleteSuccess'));
//            删除属性值
            ProductAttributeValue::where(['product_id' => $id])->delete();
        } else session_tips(admin_language('common_deleteFailed'));
        return back();
    }


    /*
     * 产品分类所有
     * */
    public function productCategory() {
        session(['breadcrumb' => ['url' => 'product/category', 'modular' => admin_language('common_product'), 'action' => admin_language('product_category')]]);
        $productCategory = ProductCategory::sortCategory(ProductCategory::orderBy('id', 'asc')->get(), 0, 0);
        $productCategoryGroupPid = ProductCategory::select('pid')->groupBy('pid')->get();


        return view('admin/product/productCategory', compact('productCategory', 'productCategoryGroupPid'), ['other' => ['navActive' => 'product', 'navActiveSon' => 'productCategory']]);
    }

    /*
     * 分类添加
     * */
    public function productCategoryAdd(Request $request) {
        if ($request->isMethod('get')) {
            session(['breadcrumb' => ['url' => 'product/category', 'modular' => admin_language('common_product'), 'action' => admin_language('common_add')]]);
            $categoryList = ProductCategory::sortCategory(ProductCategory::all(), 0, 0);
            $language = Language::where('modular', 1)->get();

            return view('admin/product/productCategoryAdd', compact('categoryList', 'language'), ['other' => ['navActive' => 'product', 'navActiveSon' => 'productCategory']]);
        }

        if ($request->isMethod('post')) {
            $post = $request->all();

            if (!$post['language_key']) {
                exit(json_encode(['status' => 50, 'msg' => admin_language('verification_Name')]));
            }
            if (ProductCategory::create($request->all())) {

                //将语言添加入语言包
                foreach ($request->lang as $k => $l) {
                    if (!empty($l)) {
                        $this->addLangData($k, [$request->language_key => $l], 1);
                    }
                }
                exit(json_encode(['status' => 1, 'msg' => admin_language('common_addSuccess'), 'url' => url('admin/product/category')]));
            } else {
                exit(json_encode(['status' => 50, 'msg' => admin_language('common_addFailed')]));
            }

        }
    }

    /*
     * 分类编辑
     * */
    public function productCategoryEdit(Request $request, $id) {
        if ($request->isMethod('get')) {
            session(['breadcrumb' => ['url' => 'product/category', 'modular' => admin_language('common_product'), 'action' => admin_language('common_edit')]]);

            $categoryList = ProductCategory::sortCategory(ProductCategory::all(), 0, 0);
            $categoryOne = ProductCategory::find($id);
            $isLastSonCategory = !ProductCategory::where(['pid' => $id])->first();
            $language = Language::where('modular', 1)->get();
            return view('admin/product/productCategoryEdit', compact('language', 'categoryList', 'categoryOne', 'isLastSonCategory'), ['other' => ['navActive' => 'product', 'navActiveSon' => 'productCategory']]);
        }
        if ($request->isMethod('post')) {
            $post = $request->all();

            $data = ProductCategory::find($post['id']);
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
            exit(json_encode(['status' => 1, 'msg' => admin_language('common_updateSuccess'), 'url' => url('admin/product/category')]));


        }
    }

    /*
     * 分类删除
     * */
    public function productCategoryDelete($id) {

        if (ProductCategory::where(['pid' => $id])->first()) {
            session_tips(admin_language('common_forbiddenToDelete'));
        } else {
            if (ProductCategory::destroy($id)) session_tips(admin_language('common_deleteSuccess'));
            else session_tips(admin_language('common_deleteFailed'));
        }

        return back();
    }

    /*
     * 属性组
     * */
    public function attributeGroup() {

        session(['breadcrumb' => ['url' => 'product/attribute/group', 'modular' => admin_language('common_product'), 'action' => admin_language('product_attribute')]]);
        $productAttributeGroup = ProductAttributeGroup::get();
        $productAttributeType = ProductAttributeType::get();
        return view('admin/product/attributeGroup', compact('productAttributeGroup', 'productAttributeType'), ['other' => ['navActive' => 'product', 'navActiveSon' => 'productAttributeGroup']]);

    }

    /*
     * 属性组添加
     * */
    public function attributeGroupAdd(Request $request) {
        if ($request->isMethod('get')) {
            session(['breadcrumb' => ['url' => 'product/attribute/group', 'modular' => admin_language('common_product'), 'action' => admin_language('product_attribute')]]);
            $language = Language::where('modular', 1)->get();
            return view('admin/product/attributeGroupAdd', compact('language'), ['other' => ['navActive' => 'product', 'navActiveSon' => 'productAttributeGroup']]);
        }
        if ($request->isMethod('post')) {
            //将语言添加入语言包
            foreach ($request->lang as $k => $l) {
                if (!empty($l)) {
                    $this->addLangData($k, [$request->language_key => $l], 2);
                }
            }
            ProductAttributeGroup::create([
                'language_key' => $request->language_key
            ]);
            exit(json_encode(['status' => 1, 'msg' => admin_language('common_addSuccess'), 'url' => url('admin/product/attribute/group')]));
        }
    }

    /*
     * 属性组编辑
     * */
    public function attributeGroupEdit(Request $request, $id) {
        if ($request->isMethod('get')) {
            session(['breadcrumb' => ['url' => 'product/attribute/group', 'modular' => admin_language('common_product'), 'action' => admin_language('product_attribute')]]);
            $language = Language::where('modular', 1)->get();
            $attributeGroupOne = ProductAttributeGroup::find($id);
            return view('admin/product/attributeGroupEdit', compact('language', 'attributeGroupOne'), ['other' => ['navActive' => 'product', 'navActiveSon' => 'productAttributeGroup']]);

        }
        if ($request->isMethod('post')) {
            $attributeGroupOne = ProductAttributeGroup::find($request->id);
            $attributeGroupOne->language_key = $request->language_key;
            $attributeGroupOne->save();
            //将语言添加入语言包
            foreach ($request->lang as $k => $l) {
                if (!empty($l)) {
                    $this->addLangData($k, [$request->language_key => $l], 2);
                }
            }
            exit(json_encode(['status' => 1, 'msg' => admin_language('common_updateSuccess'), 'url' => url('admin/product/attribute/group')]));

        }
    }

    /*
     * 属性组删除
     * */
    public function attributeGroupDelete(Request $request, $id) {
        if ($request->type == 1) {
            if (ProductAttributeType::where('group_id', $id)->first()) {
                session_tips(admin_language('common_forbiddenToDelete'));
                return back();
            }
            if (ProductAttributeGroup::where('id', $id)->delete()) {
                session_tips(admin_language('common_deleteSuccess'));
            } else {
                session_tips(admin_language('common_deleteFailed'));
            }
            return back();
        } else if ($request->type == 2) {
            if (ProductAttributeType::where('id', $id)->delete()) {
                session_tips(admin_language('common_deleteSuccess'));
            } else {
                session_tips(admin_language('common_deleteFailed'));
            }
            return back();
        }
    }

    /*
     * 属性名编辑
     * */
    public function attributeTypeEdit(Request $request, $id) {
        if ($request->isMethod('get')) {

            $attributeTypeOne = ProductAttributeType::find($id);
            session(['breadcrumb' => ['url' => 'product/attribute/group', 'modular' => admin_language('common_product'), 'action' => admin_language('product_attribute')]]);

            $language = Language::where('modular', 1)->get();
            return view('admin/product/attributeTypeEdit', compact('language', 'attributeTypeOne'), ['other' => ['navActive' => 'product', 'navActiveSon' => 'productAttributeGroup']]);
        }
        if ($request->isMethod('post')) {
            /*"_token" => "aPjoRpJH1lGVNXeqTLyZnF29HIei0TZSV80kXHeY"  "language_key" => "common_name"  "lang" => array:3 [    "en" => "Name"    "zh" => "名称"    "tc" => "名称"  ]  "input_type" => "1"  "default_val" => "123"
             * */
            foreach ($request->lang as $k => $l) {
                if (!empty($l)) {
                    $this->addLangData($k, [$request->language_key => $l], 1);
                }
            }
            $attributeTypeOne = ProductAttributeType::find($id);
            $attributeTypeOne->language_key = $request->language_key;
            $attributeTypeOne->input_type = $request->input_type;
            $attributeTypeOne->default_val = $request->default_val;
            $attributeTypeOne->save();
            exit(json_encode(['status' => 1, 'msg' => admin_language('common_updateSuccess'), 'url' => url('admin/product/attribute/group')]));

        }
    }

    /*
     * 属性组添加分类
     * */
    public function attributeTypeAdd(Request $request) {
        if ($request->isMethod('get')) {
            session(['breadcrumb' => ['url' => 'product/attribute/group', 'modular' => admin_language('common_product'), 'action' => admin_language('product_attribute')]]);
            $group = ProductAttributeGroup::all();

            $language = Language::where('modular', 1)->get();
            return view('admin/product/attributeTypeAdd', compact('group', 'language', 'attributeTypeOne'), ['other' => ['navActive' => 'product', 'navActiveSon' => 'productAttributeGroup']]);

        }
        if ($request->isMethod('post')) {
            /*
             *"group" => "7"
             * "language_key" => ""
             * "lang" => array:3 [    "en" => ""    "zh" => ""    "tc" => ""  ]
             * "input_type" => "1"
             * "default_val" => ""
             * */
            if (ProductAttributeType::create([
                'language_key' => $request->language_key,
                'input_type' => $request->input_type,
                'default_val' => $request->default_val,
                'group_id' => $request->group,
            ])) {
                foreach ($request->lang as $k => $l) {
                    if (!empty($l)) {
                        $this->addLangData($k, [$request->language_key => $l], 1);
                    }
                }
                exit(json_encode(['status' => 1, 'msg' => admin_language('common_addSuccess'), 'url' => url('admin/product/attribute/group')]));
            }


        }


    }

    /*
     * 添加产品时获取选择的属性列表
     * */
    public function productAttributeTypeAdd(Request $request) {
        //存在id就是编辑
        if ($request->has('id')) {
            $categoryAttribute = ProductAttributeType::get();
            $edit = ProductAttributeValue::where('product_id', $request->id)->get();

            return view('admin/product/ajax/ajaxGetCategoryAttributeEdit', compact('categoryAttribute', 'edit'));
        } else {
            $categoryAttribute = ProductAttributeType::whereIn('id', $request->name)->get();
            return view('admin/product/ajax/ajaxGetCategoryAttribute', compact('categoryAttribute'));
        }

    }

    /*
     *获取所有产品分类的父级分类
     * */
    private function getCategoryParents($id) {
        if (!in_array($id, self::$parents)) {
            self::$parents [] = $id;
        }
        $pid = ProductCategory::where('id', $id)->value('pid');
        if ($pid != 0) {
            if (!in_array($pid, self::$parents)) {
                self::$parents [] = $pid;
            }
            $this->getCategoryParents($pid);
        }
    }
}