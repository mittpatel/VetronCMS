<?php
/**
 * Created by PhpStorm.
 * User: LONG JIN WEN
 * Date: 2017/6/5
 * Time: 15:23
 */

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

class SettingController extends CommonController {

    /*
     * 切换语言
     * */
    public function setLanguage($language) {

        app()->setLocale($language);
        session()->put(['ADMIN_LOCALE' => $language]);
        return back();
    }

    public function page($page) {
        dd($page);
    }

    /*
     * 基本设置
     * */
    public function settingDefault(Request $request) {
        if ($request->isMethod('get')) {
            session(['breadcrumb' => ['url' => 'setting/default', 'modular' => admin_language('common_setting'), 'action' => admin_language('setting_basic')]]);

            return view('admin/setting/default', compact(''), ['other' => ['navActive' => 'setting', 'navActiveSon' => 'settingDefault']]);

        }
        if ($request->isMethod('post')) {

            $res = $this->arrInFile($_POST, 'aSetting');
            if ($res) exit(json_encode(['status' => 1, 'msg' => admin_language('common_updateSuccess')]));
            else exit(json_encode(['status' => 50, 'msg' => admin_language('common_updateFailed')]));
        }
    }


    /*
     * 上传logo和icon
     * */
    public function ajaxUploadLogoIcon() {
        if ($_FILES['logo']) {
            $res = $this->upLoads('logo', 'logo');
            if ($res) {
                exit(json_encode(['status' => 1, 'url' => asset($res[0]), 'path' => $res[0], 't' => 1]));
            } else {
                exit(json_encode(['status' => 50, 'msg' => admin_language('common_uploadFailed')]));
            }
        } else {
            $res = $this->upLoads('icon', 'logo', ['ico']);
            if ($res) {
                exit(json_encode(['status' => 1, 'url' => asset($res[0]), 'path' => $res[0], 't' => 2]));
            } else {
                exit(json_encode(['status' => 50, 'msg' => admin_language('common_uploadFailed')]));
            }
        }

    }

    /*
     * 发送邮件测试
     * */
    public function sendEmailTest() {
        if (!$_GET['email']) {
            exit(json_encode(['status' => 50, 'msg' => admin_language('verification_Content')]));
        }
        $email = $_GET['email'];
        $send_res = \Mail::raw('This is test!', function ($message) use ($email) {
            $message->to($email)->subject('Send test');
        });

        exit(json_encode(['status' => 1, 'msg' => admin_language('setting_successfully')]));

    }
}