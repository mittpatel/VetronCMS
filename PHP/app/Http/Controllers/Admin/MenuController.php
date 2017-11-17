<?php
/**
 * Created by PhpStorm.
 * User: LONG JIN WEN
 * Date: 2017/6/5
 * Time: 15:59
 */

namespace App\Http\Controllers\Admin;


use App\Http\Model\Admin\Language;
use Illuminate\Http\Request;
use App\Http\Model\Admin\Menu;
use App\Http\Model\Admin\HomeMenu;

class MenuController extends CommonController {

    /*
     *前台菜单
     * */
    public function homeMenuList() {
        session(['breadcrumb' => ['url' => 'setting/menu', 'modular' => admin_language('menu_homeMenu'), 'action' => admin_language('common_lists')]]);
        $data = HomeMenu::sortHomeMenu(HomeMenu::orderBy('type')->orderBy('order')->get());
        return view('admin/menu/homeMenuList', compact('data'), ['other' => ['navActive' => 'menu', 'navActiveSon' => 'homeMenu']]);
    }

    /*
     * 前台菜单添加
     * */
    public function homeMenuAdd(Request $request) {
        if ($request->isMethod('get')) {
            session(['breadcrumb' => ['url' => 'setting/menu', 'modular' => admin_language('menu_homeMenu'), 'action' => admin_language('common_add')]]);
            $menu = HomeMenu::sortHomeMenu(HomeMenu::orderBy('id', 'asc')->get());
            $language = Language::where('modular', 1)->get();

            return view('admin/menu/homeMenuAdd', compact('menu', 'language'), ['other' => ['navActive' => 'menu', 'navActiveSon' => 'homeMenu']]);
        }
        if ($request->isMethod('post')) {


            $this->validate($request, [
                'language_key' => 'required',
                'route' => 'required',

            ], [
                'language_key.required' => admin_language('common_languageKeyNotNull'),
                'route.required' => admin_language('menuM_RoutingCannotBeNull'),
            ]);

            if (HomeMenu::create($request->all())) {
                //将语言添加入语言包
                foreach ($request->lang as $k => $l) {
                    if (!empty($l)) {
                        $this->addLangData($k, [$request->language_key => $l], 1);
                    }
                }
                return redirect('admin/setting/homemenu')->with('tips', admin_language('common_addSuccess'));
            }
            return back()->with('tips', admin_language('common_addFailed'));
        }
    }

    /*
     * 前台菜单编辑
     * */
    public function homeMenuEdit(Request $request, $id) {
        if ($request->isMethod('get')) {
            session(['breadcrumb' => ['url' => 'setting/menu', 'modular' => admin_language('menu_homeMenu'), 'action' => admin_language('common_edit')]]);
            $menuOne = HomeMenu::findOrFail($id);
            $menu = HomeMenu::sortHomeMenu(HomeMenu::orderBy('id', 'asc')->get());
            //判断是不是最低级分类，否则不让编辑
            $isLow = HomeMenu::where(['p_id' => $id])->value('id');
            $language = Language::where('modular', 1)->get();
            return view('admin/menu/homeMenuEdit', compact('menu', 'menuOne', 'isLow', 'language'), ['other' => ['navActive' => 'menu', 'navActiveSon' => 'homeMenu']]);
        }
        if ($request->isMethod('post')) {

            $menuOne = HomeMenu::findOrFail($request->id);
            $menuOne->language_key = $request->language_key;
            $menuOne->route = $request->route;
            $menuOne->p_id = $request->p_id;
            $menuOne->order = $request->order;
            $menuOne->icon = $request->icon;
            $menuOne->active = $request->active;
            $menuOne->note = $request->note;
            $menuOne->type = $request->type;
            $menuOne->target = $request->target;
            $menuOne->modular_id = $request->modular_id;
            $menuOne->save();
            //将语言添加入语言包
            foreach ($request->lang as $k => $l) {
                if (!empty($l)) {
                    $this->addLangData($k, [$request->language_key => $l], 1);
                }
            }
            return back()->with('tips', admin_language('common_updateSuccess'));

        }
    }

    /*
     * 前台菜单删除
     * */
    public function homeMenuDelete($id) {
        if (HomeMenu::where(['p_id' => $id])->value('id')) {
            session_tips(admin_language('common_forbiddenToDelete'));
        } else {
            if (HomeMenu::destroy($id)) {
                session_tips(admin_language('common_deleteSuccess'));
            } else {
                session_tips(admin_language('common_deleteFailed'));
            }
        }
        return back();
    }

    /*
     * 前台菜单状态
     * */
    public function homeMenuStatus(Request $request) {
        if ($request->action == 'setStatus') {
            $menuOne = HomeMenu::find($request->id);
            if ($menuOne->is_show == 1) $menuOne->is_show = 2;
            else $menuOne->is_show = 1;
            if ($menuOne->save()) exit(json_encode(['status' => 1, 'msg' => admin_language('common_updateSuccess')]));
            exit(json_encode(['status' => 50, 'msg' => admin_language('common_updateFailed')]));
        } elseif ($request->action == 'setIndex') {
            HomeMenu::where('id', '!=', '0')->update(['index' => 2]);
            $menuOne = HomeMenu::find($request->id);
            $menuOne->index = 1;
            if ($menuOne->save()) exit(json_encode(['status' => 1, 'msg' => admin_language('common_updateSuccess')]));
            exit(json_encode(['status' => 50, 'msg' => admin_language('common_updateFailed')]));

        }

    }

    /*
     * 后台菜单列表
     * */
    public function menuList() {
        //面包屑
        session(['breadcrumb' => ['url' => 'setting/menu', 'modular' => admin_language('menu_menu'), 'action' => admin_language('common_lists')]]);

        $data = Menu::orderBy('order', 'asc')->get();
        return view('admin/menu/menuList', compact('data'), ['other' => ['navActive' => 'menu', 'navActiveSon' => 'setting_menu']]);
    }

    /*
     * 菜单添加
     * */
    public function menuAdd(Request $request) {

        if ($request->isMethod('get')) {
            //面包屑
            session(['breadcrumb' => ['url' => 'setting/menu', 'modular' => admin_language('menu_menu'), 'action' => admin_language('common_add')]]);
            $language = Language::where('modular', 2)->get();

            $menu = Menu::where(['p_id' => 0])->get();
            return view('admin/menu/menuAdd', compact('menu', 'language'), ['other' => ['navActive' => 'menu', 'navActiveSon' => 'setting_menu']]);
        }
        if ($request->isMethod('post')) {

            $data = $this->getRequestData('post', ['_token', 'lang'], true);
            $tips = [
                'language_key' => admin_language('common_languageKeyNotNull'),
                'route' => admin_language('menuM_RoutingCannotBeNull'),
                'auth' => admin_language('menuM_PermissionsCannotBeEmpty'),
                'active' => admin_language('menuM_KeywordSelectionCannotBeNull')
            ];

            if ($this->verificationNull($data, $tips)) {
                if (Menu::create($data)) {
                    //将语言添加入语言包
                    foreach ($request->lang as $k => $l) {
                        if (!empty($l)) {
                            $this->addLangData($k, [$request->language_key => $l], 2);
                        }
                    }

                    session_tips(admin_language('common_addSuccess'));
                    return redirect('admin/setting/menu');
                } else {
                    session_tips(admin_language('common_deleteFailed'));
                    return back();
                }
            } else {
                return back();
            }

        }
    }

    /*
     * 菜单编辑
     * */
    public function menuEdit(Request $request, $id) {

        if ($request->isMethod('get')) {
            session(['breadcrumb' => ['url' => 'setting/menu', 'modular' => admin_language('menu_menu'), 'action' => admin_language('common_edit')]]);
            $data = Menu::where(['id' => $id])->first();
            $menu = Menu::where(['p_id' => 0])->get();
            $language = Language::where('modular', 1)->get();
            return view('admin/menu/menuEdit', compact('data', 'menu', 'language'), ['other' => ['navActive' => 'menu', 'navActiveSon' => 'setting_menu']]);
        }
        if ($request->isMethod('post')) {

            $post = $this->getRequestData('post', ['_token', 'lang']);
            $tips = [
                'language_key' => admin_language('common_languageKeyNotNull'),
                'route' => admin_language('menuM_RoutingCannotBeNull'),
                'auth' => admin_language('menuM_PermissionsCannotBeEmpty'),
                'active' => admin_language('menuM_KeywordSelectionCannotBeNull')
            ];

            if ($this->verificationNull($post, $tips)) {
                //将语言添加入语言包
                foreach ($request->lang as $k => $l) {
                    if (!empty($l)) {
                        $this->addLangData($k, [$request->language_key => $l], 2);
                    }
                }
                Menu::where(['id' => $id])->update($post);
                session_tips(admin_language('common_updateSuccess'));

                return back();
            } else {
                return back();
            }
        }
    }

    /*
     * 菜单删除
     * */
    public function menuDelete($id) {
        if (Menu::where(['p_id' => $id])->value('id')) {
            session_tips(admin_language('common_forbiddenToDelete'));
        } else {
            if (Menu::destroy($id)) {
                session_tips(admin_language('common_deleteSuccess'));
            } else {
                session_tips(admin_language('common_deleteFailed'));
            }
        }
        return back();
    }

}