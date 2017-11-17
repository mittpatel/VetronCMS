<?php
/**
 * Created by PhpStorm.
 * User: LONG JIN WEN
 * Date: 2017/6/5
 * Time: 11:30
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class LoginController extends Controller {
    public function login(Request $request) {


        if ($request->isMethod('get')) {
            if ($request->has('effective')) {
                return ['sum' => $request->munA + $request->munB];
            }

            if (session()->has('vetronCmsLogin')) return redirect('admin');
            return view('admin/login/login');
        }
        if ($request->isMethod('post')) {

            $post = html_special_chars($_POST);
            session()->put(['login_data' => $post]);
            if (!$post['name']) {
                session()->put(['error_tips' => admin_language('verification_Name')]);
                return back();
            }
            if (!$post['password']) {
                session()->put(['error_tips' => admin_language('verification_Password')]);
                return back();
            }

            $login = \App\Http\Model\Admin\AdminUser::where(['name' => $post['name'], 'password' => md5($post['password'] . 'vetron')])->first();


            if ($login) {
                if ($login->status != 1) return back()->with('error_tips', admin_language('other_AccountIsDisabled'));
                $history['ip'] = $request->ip();
                $city = $this->getCity($history['ip']);      //获取城市

                foreach ($city[0] as $value2) {
                    $history['city'] .= $value2;
                }
                $history['uid'] = $login->id;
                $history['browser'] = $this->getBrowser();
                $history['create_time'] = date('Y-m-d H:i:s');
                \App\Http\Model\Admin\AdminHistory::create($history);

                session()->put(['vetronCmsLogin' => $login]);
                if (!session()->has('beforeLanding'))
                    return redirect('/admin');
                return redirect(session('beforeLanding'));
            } else {
                session()->put(['error_tips' => admin_language('verification_UsernameOrPassword')]);
                return back();
            }

        }

    }

    public function logout() {
        session()->flush();
        return redirect('admin/login');
    }

    public function getBrowser() {
        if (!empty($_SERVER['HTTP_USER_AGENT'])) {
            $br = $_SERVER['HTTP_USER_AGENT'];
            if (preg_match('/MSIE/i', $br)) {
                $br = 'MSIE';
            } elseif (preg_match('/Firefox/i', $br)) {
                $br = 'Firefox';
            } elseif (preg_match('/Chrome/i', $br)) {
                $br = 'Chrome';
            } elseif (preg_match('/Safari/i', $br)) {
                $br = 'Safari';
            } elseif (preg_match('/Opera/i', $br)) {
                $br = 'Opera';
            } else {
                $br = 'Other';
            }
            return $br;
        } else {
            return "获取浏览器信息失败！";
        }
    }

    public function getCity($ip = '') {
        if (empty($ip)) {
            $ip = $this->Getip();
        }
        $ipadd = file_get_contents("http://int.dpool.sina.com.cn/iplookup/iplookup.php?ip=" . $ip); //根据新浪api接口获取
        if ($ipadd) {
            $charset = iconv("gbk", "utf-8", $ipadd);
            preg_match_all("/[\x{4e00}-\x{9fa5}]+/u", $charset, $ipadds);
            return $ipadds;   //返回一个二维数组
        } else {
            return "addree is none";
        }
    }
}