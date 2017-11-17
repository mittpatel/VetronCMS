<?php
/**
 * Created by PhpStorm.
 * User: LONG JIN WEN
 * Date: 2017/6/29
 * Time: 9:48
 */

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Http\Model\Admin\AdminGroup;
use App\Http\Model\Admin\AdminUser;
use App\Http\Model\Admin\Language;
use App\Http\Model\Admin\Menu;
use Illuminate\Http\Request;


class AdminsController extends CommonController {
    /*
     * 管理员列表
     * */
    public function userList(Request $request) {
        session(['breadcrumb' => ['url' => 'administrators/user', 'modular' => admin_language('admin_adminUser'), 'action' => admin_language('common_lists')]]);

        $groupList = AdminGroup::all();
        //只查找属于自己创建的
        if ($request->has('g')) {
            $userList = AdminUser::whereRaw("FIND_IN_SET(?,g_id)", [$request->g])->get();

        } else {

            $userList = AdminUser::where(['p_id' => UID])->orWhere('id',UID)->get();

        }
        $subordinateGroupList = $this->getThisSubordinateGroup();

        return view('admin/admins/userList', compact('userList', 'groupList', 'subordinateGroupList', 'request'), ['other' => ['navActive' => 'administrators', 'navActiveSon' => 'administratorsUser']]);

    }


    /*
     * 分配组权限
     * */
    public function groupAuth(Request $request, $id) {
        if ($request->isMethod('get')) {
            if ($this->checkGroupBelongSessionUser($id)) {

                $groupOne = AdminGroup::find($id);
                session(['breadcrumb' => ['url' => 'administrators/group', 'modular' => admin_language('menu_group'), 'action' => admin_language('common_auth')]]);
//              如果是超级管理员，具备所有权限
                if (UID == 1 && GID == 0) {
                    $menuDataAuth = Menu::all();
                } else {
//                  否则只需要获取当前组的权限
                    $menuDataAuth = Menu::whereIn('id', explode(',', AdminGroup::where(['id' => GID])->value('auth_list')))->get();
                }

                return view('admin/admins/groupAuth', compact('menuDataAuth', 'id', 'groupOne'), ['other' => ['navActive' => 'administrators', 'navActiveSon' => 'administratorsGroup']]);

            } else {
                return redirect(404);
            }
        }

        if ($request->isMethod('post')) {
            $groupOne = AdminGroup::find($request->g_id);
            $groupOne->auth_list = implode(',', $request->menu);
            $groupOne->save();
            return back();
        }
    }

    /*
     * 管理员添加
     * */
    public function userAdd(Request $request) {
        if ($request->isMethod('get')) {
            session(['breadcrumb' => ['url' => 'administrators/user', 'modular' => admin_language('admin_adminUser'), 'action' => admin_language('common_add')]]);
            //只允许添加到属于自己的组
//            $groupList = AdminGroup::sortAdminGroup(AdminGroup::where(['u_id' => UID])->get());
            $groupList = AdminGroup::where(['u_id' => UID])->get();
            return view('admin/admins/userAdd', compact('groupList'), ['other' => ['navActive' => 'administrators', 'navActiveSon' => 'administratorsUser']]);
        }

        if ($request->isMethod('post')) {

            if (!trim($request->name)) exit(json_encode(['status' => 50, 'msg' => admin_language('verification_Name')]));
            if (!trim($request->password)) exit(json_encode(['status' => 50, 'msg' => admin_language('verification_Password')]));
            if (!trim($request->header)) exit(json_encode(['status' => 50, 'msg' => admin_language('verification_TheHeadCannotBeEmpty')]));
            if (!$request->g_id) exit(json_encode(['status' => 50, 'msg' => admin_language('verification_SelectAtLeastOneGroup')]));

            $userOne = AdminUser::create($request->all());

            if ($userOne) {
                $userOne->password = md5($userOne->password . 'vetron');
                $userOne->create_time = time();
                $userOne->g_id = implode(',', $request->g_id);
                if ($userOne->save()) {
                    exit(json_encode(['status' => 1, 'msg' => admin_language('common_addSuccess'), 'url' => url('admin/administrators/user')]));
                } else {
                    AdminUser::destroy($userOne->id);
                    exit(json_encode(['status' => 50, 'msg' => admin_language('common_addFailed')]));
                }
            } else {
                exit(json_encode(['status' => 50, 'msg' => admin_language('common_addFailed')]));
            }


        }
    }

    /*
     * 编辑管理员
     * */
    public function userEdit(Request $request, $id) {
        if ($request->isMethod('get')) {
            if ($id == 1) return back();
            $userOne = AdminUser::findOrFail($id);
            session(['breadcrumb' => ['url' => 'administrators/user', 'modular' => admin_language('admin_adminUser'), 'action' => admin_language('common_edit')]]);
//            $groupList = AdminGroup::sortAdminGroup(AdminGroup::all());
            $groupList = AdminGroup::where(['u_id' => UID])->get();

            return view('admin/admins/userEdit', compact('groupList', 'userOne'), ['other' => ['navActive' => 'administrators', 'navActiveSon' => 'administratorsUser']]);

        }
        if ($request->isMethod('post')) {

            $userOne = AdminUser::find($request->id);
            $userOne->name = $request->name;
            $userOne->email = $request->email;
            $userOne->phone = $request->phone;
            $userOne->company = $request->company;
            $userOne->address = $request->address;
            $userOne->introduction = $request->introduction;
            $userOne->g_id = implode(',', $request->g_id);
            $userOne->header = $request->header;
            if ($request->password != $userOne->password) {
                $userOne->password = md5($request->password . 'vetron');
            }
            if ($userOne->save()) {
                exit(json_encode(['status' => 1, 'msg' => admin_language('common_updateSuccess'), 'url' => url('admin/administrators/user')]));
            }
            exit(json_encode(['status' => 50, 'msg' => admin_language('common_updateFailed'), 'url' => url('admin/administrators/user')]));

        }
    }

    /*
     * 设置管理员状态
     * */
    public function userSetStatus() {
        $userOne = AdminUser::find($_GET['id']);
        $userOne->status = $userOne->status == 1 ? 2 : 1;
        if ($userOne->save()) {
            exit(json_encode(['status' => 1, 'msg' => admin_language('common_updateSuccess')]));
        } else {
            exit(json_encode(['status' => 50, 'msg' => admin_language('common_updateFailed')]));
        }
    }

    /*
     * 删除管理员
     * */
    public function userSetDelete($id) {
        if ($id == 1) return back();
        if (AdminUser::destroy($id)) return back()->with('tips', admin_language('common_deleteSuccess'));
        return back()->with('tips', admin_language('common_deleteFailed'));
    }


    /*
     * 组列表
     * */
    public function groupList() {
        session(['breadcrumb' => ['url' => 'administrators/group', 'modular' => admin_language('menu_group'), 'action' => admin_language('common_lists')]]);


        $groupList = $this->getThisSubordinateGroup();
        $userList = AdminUser::all();

        return view('admin/admins/groupList', compact('groupList', 'userList'), ['other' => ['navActive' => 'administrators', 'navActiveSon' => 'administratorsGroup']]);
    }


    /*
     * 组添加
     * */
    public function groupAdd(Request $request) {
        if ($request->isMethod('get')) {
            session(['breadcrumb' => ['url' => 'administrators/group', 'modular' => admin_language('menu_group'), 'action' => admin_language('common_add')]]);
//            $groupList = AdminGroup::sortAdminGroup(AdminGroup::all());
            $language = Language::where('modular', 2)->get();
            return view('admin/admins/groupAdd', compact('language'), ['other' => ['navActive' => 'administrators', 'navActiveSon' => 'administratorsGroup']]);

        }
        if ($request->isMethod('post')) {
            if (!$request->has('language_key')) {
                exit(json_encode(['status' => 50, 'msg' => admin_language('common_languageKeyNotNull')]));
            }
//

            $data['language_key'] = $request->language_key;

            $data['note'] = $request->note;
            $data['u_id'] = UID;
            $data['p_id'] = GID;

            $create = AdminGroup::create($data);
            if ($create) {
                //将语言添加入语言包
                foreach ($request->lang as $k => $l) {
                    if (!empty($l)) {
                        $this->addLangData($k, [$request->language_key => $l], 2);
                    }
                }
                //组路径
                if ($create->p_id == 0) {
                    $create->path = $create->id;
                } else {
                    $create->path = AdminGroup::where(['id' => $create->p_id])->value('path') . ',' . $create->id;
                }
                $create->save();
                exit(json_encode(['status' => 1, 'msg' => admin_language('common_addSuccess'), 'url' => url('admin/administrators/group/auth', [$create->id])]));
            } else {
                exit(json_encode(['status' => 50, 'msg' => admin_language('common_addFailed')]));
            }
        }
    }

    /*
     * 组编辑
     * */
    public function groupEdit(Request $request, $id) {
        if ($request->isMethod('get')) {
            $groupOne = AdminGroup::findOrFail($id);
            //判断是否存在下级分类，有则不可编辑,或者是自己的顶级分类
            /* if (AdminGroup::where(['p_id' => $id])->first() || $groupOne->u_id==UID) {
                 $isEdit = false;
             } else {
                 $isEdit = true;
             }
             if (UID == 1) {
                 $groupList = $this->getThisSubordinateGroup();
             } else {
                 $groupList = $this->getThisSubordinateGroup();
             }*/

            $language = Language::where('modular', 2)->get();
            session(['breadcrumb' => ['url' => 'administrators/group', 'modular' => admin_language('menu_group'), 'action' => admin_language('common_edit')]]);
            return view('admin/admins/groupEdit', compact('language', 'groupOne', 'groupList', 'isEdit'), ['other' => ['navActive' => 'administrators', 'navActiveSon' => 'administratorsGroup']]);

        }
        if ($request->isMethod('post')) {
            $groupOne = AdminGroup::find($request->id);

            $groupOne->language_key = $request->language_key;
            $groupOne->note = $request->note;
            /* $groupOne->p_id=$request->g_id;
             $groupOne->path=AdminGroup::where(['id'=>$request->g_id])->value('path').','.$groupOne->id;*/

            $groupOne->save();

            //将语言添加入语言包
            foreach ($request->lang as $k => $l) {
                if (!empty($l)) {
                    $this->addLangData($k, [$request->language_key => $l], 2);
                }
            }
            exit(json_encode(['status' => 1, 'msg' => admin_language('common_updateSuccess'), 'url' => url('admin/administrators/group')]));


        }

    }

    /*
     * 组删除
     * */
    public
    function groupDelete($id) {
        if (AdminGroup::where(['p_id' => $id])->value('id')) {
            return back()->with('tips', admin_language('common_forbiddenToDelete'));
        }
        $groupOne = AdminGroup::findOrfail($id);

        if (AdminGroup::destroy($id)) {
            AdminUser::where(['g_id' => $groupOne->id])->delete();
            return back()->with('tips', admin_language('common_deleteSuccess'));
        }
        return back()->with('tips', admin_language('common_deleteFailed'));
    }

    /*
     * 组状态设置
     * */
    public function groupStatus() {
        $groupOne = AdminGroup::find($_GET['id']);
        $groupOne->status = $groupOne->status == 1 ? 2 : 1;
        if ($groupOne->save()) exit(json_encode(['status' => 1]));
        exit(json_encode(['status' => 50]));
    }

    /*
     * 验证该组是否属于登陆用户
     * */
    public
    function checkGroupBelongSessionUser($gid) {
        if (UID == 1) return true;
        if (AdminGroup::where(['id' => $gid, 'u_id' => UID])->value('id')) return true;
        return false;
    }

    /*
     * 获取自己所有的下级组
     * */
    public
    function getThisSubordinateGroup() {
        $groupListForOne = AdminGroup::where(['u_id' => UID])->get();
        $groupList = [];
        foreach ($groupListForOne as $g) {
            $id = $g->id;

            $groupList[] = AdminGroup::treeAdminGroup(AdminGroup::whereRaw("FIND_IN_SET(?,path)", [$id])->get(), $id, $g->p_id);

        }
        return $groupList;
    }

}