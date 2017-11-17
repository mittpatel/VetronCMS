<?php
/**
 * Created by PhpStorm.
 * User: LONG JIN WEN
 * Date: 2017/6/14
 * Time: 10:31
 */

namespace App\Http\Controllers\Admin;
use App\Http\Model\Admin\AdminUser;

class ProfileController extends CommonController {
    public function profile() {
        session(['breadcrumb' => ['url' => '', 'modular' => admin_language('profile'), 'action' => admin_language('profile')]]);

        $adminData=AdminUser::where(['id'=>session('vetronCmsLogin')->id])->first();
//      登陆历史
        $loginHistory = \App\Http\Model\Admin\AdminHistory::where(['uid' => 1])->orderBy('create_time', 'desc')->paginate(15);
        return view('admin/profile/profile', compact('loginHistory','adminData'), ['other' => ['navActive' => 'navProfile', 'navActiveSon' => '']]);
    }

//    更改资料
    public function changeProfile() {
        $tips = [
            'company' => admin_language('verification_company'),
            'phone' => admin_language('verification_phone'),
            'address' => admin_language('verification_address'),
        ];
        $data = $this->ajaxVerificationNull($_POST, $tips);


        if ($data["oldPassword"]) {
            if (md5($data['oldPassword'] . 'vetron') != session('vetronCmsLogin')->password) {
                exit(json_encode(['status' => 50, 'msg' => admin_language('other_OldPasswordIsIncorrect')]));
            }
            if ($data['newPassword'] != $data['repeatPassword']) {
                exit(json_encode(['status' => 50, 'msg' => admin_language('other_TwoPasswordsAreInconsistent')]));
            }
        }
        $update = [
            'header' => $data['header'] ? $data['header'] : session('vetronCmsLogin')->header,
            'phone' => $data['phone'],
            'company' => $data['company'],
            'address' => $data['address'],
            'introduction' => $data['introduction'],
            'password' => $data['oldPassword'] ? md5($data['newPassword'] . 'vetron'):session('vetronCmsLogin')->password,
        ];
        if(AdminUser::where(['id'=>session('vetronCmsLogin')->id])->update($update)){
            session()->put(['vetronCmsLogin'=>AdminUser::where(['id'=>session('vetronCmsLogin')->id])->first()]);
            session()->save();
            exit(json_encode(['status' => 1, 'msg' => admin_language('common_updateSuccess'),'url'=>url('admin/profile?a=d')]));
        }else{
            exit(json_encode(['status' => 50, 'msg' => admin_language('common_updateFailed')]));
        }


    }

//    上传头像
    public function ajaxUploadHeader() {
        $header = $this->upLoads('header', 'admin');
        if ($header) {
            exit(json_encode(['status' => 1, 'url' => asset($header[0]), 'path' => $header[0]]));
        } else {
            exit(json_encode(['status' => 2, 'msg' => admin_language('common_uploadFailed')]));
        }
    }
}