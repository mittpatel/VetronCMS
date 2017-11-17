<?php
/**
 * Created by PhpStorm.
 * User: LONG JIN WEN
 * Date: 2017/6/5
 * Time: 15:23
 */

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Model\Admin\Language;


class LanguageController extends CommonController {


    /*
     * 多语言列表
     * */
    public function language() {

        session(['breadcrumb' => ['url' => 'setting/language', 'modular' => admin_language('language_multiLanguage'), 'action' => admin_language('common_lists')]]);
        $language = Language::orderBy('modular', 'asc')->get();

        return view('admin/language/language', compact('language'), ['other' => ['navActive' => 'setting', 'navActiveSon' => 'settingLanguage']]);
    }

    /*
     * 编辑多语言文件
     * */
    public function edit(Request $request, $language, $fileName) {

        if ($request->isMethod('get')) {
            session(['breadcrumb' => ['url' => 'setting/language', 'modular' => admin_language('language_multiLanguage'), 'action' => admin_language('common_edit')]]);
            if (!$language || !$fileName) return back();
            $filePath = base_path() . '/resources/lang/' . $language . '/' . $fileName . '.php';
            if (file_exists($filePath)) {
                $languageType = Language::where(['folder' => $language, 'file_name' => $fileName])->value('language_key');

                $data = require $filePath;
                return view('admin/language/edit', compact('data', 'languageType'), ['other' => ['navActive' => 'setting', 'navActiveSon' => 'settingLanguage']]);
            } else {
                return back();
            }
        }
        if ($request->isMethod('post')) {
            $data = $_POST;
            foreach ($data['languageKey'] as $k => $languageValue) {
                if (trim($languageValue) && trim($data['languageValue'][$k])) {
                    $data[$languageValue] = $data['languageValue'][$k];
                }
            }
            unset($data['_token']);
            unset($data['languageKey']);
            unset($data['languageValue']);
            $filePath = base_path() . '/resources/lang/' . $language . '/' . $fileName . '.php';
            $res = $this->arrWriteFile($data, $filePath);
            if ($res) {
                session_tips(admin_language('common_updateSuccess'));
            } else {
                session_tips(admin_language('common_updateFailed'));

            }
            return back();

        }

    }

    /*
     * 添加语言
     * */
    public function add(Request $request) {
        if ($request->isMethod('get')) {
            session(['breadcrumb' => ['url' => 'setting/language', 'modular' => admin_language('language_multiLanguage'), 'action' => admin_language('common_add')]]);
            $languageList = Language::orderBy('modular', 'asc')->get();
            return view('admin/language/add', compact('languageList'), ['other' => ['navActive' => 'setting', 'navActiveSon' => 'settingLanguage']]);
        }
        if ($request->isMethod('post')) {

            if (!isset($_POST['modular'])) {
                exit(json_encode(['status' => 50, 'msg' => admin_language('language_PleaseSelectTheModule')]));
            }
            $tips = [
                'language_key' => admin_language('common_languageKeyNotNull'),
                'folder' => admin_language('language_MultilingualEnglishAbbreviationCanNotBeEmpty'),
            ];


//            判断多语言是否存在
            foreach ($_POST['modular'] as $modular) {

                if (Language::where(['folder' => $_POST['folder'], 'modular' => $modular])->first()) {
                    exit(json_encode(['status' => 50, 'msg' => admin_language('language_TheLanguageAlreadyExists')]));
                    break;
                }
            }
            $data = $this->ajaxVerificationNull($_POST, $tips);

//            判断文件夹是否存在
            if (!is_dir(base_path() . '/resources/lang/' . $data['folder'])) {
                mkdir(base_path() . '/resources/lang/' . $data['folder'], 0777);
                sleep(1);
            }
            if ($data['langKey'] != 0) {

                $langKey = Language::where(['id' => $data['langKey']])->first();
                $languageData = require base_path() . '/resources/lang/' . $langKey->folder . "/" . $langKey->file_name . ".php";
            }

            sleep(1);
            foreach ($_POST['modular'] as $modular) {

                if ($modular == 1) {
                    fopen(base_path() . '/resources/lang/' . $data['folder'] . "/homeLanguage.php", "w");
                    Language::create([
                        'folder' => $data['folder'],
                        'language_key' => $data['language_key'],
                        'note' => $data['note'],
                        'create_time' => time(),
                        'modular' => $modular,
                        'file_name' => 'homeLanguage',
                    ]);
                    sleep(1);
                    if ($data['langKey'] != 0) {
                        //                同步
                        $this->arrWriteFile($languageData, base_path() . '/resources/lang/' . $data['folder'] . "/homeLanguage.php");
                    }

                } else {
                    fopen(base_path() . '/resources/lang/' . $data['folder'] . "/adminLanguage.php", "w");
                    Language::create([
                        'folder' => $data['folder'],
                        'language_key' => $data['language_key'],
                        'note' => $data['note'],
                        'create_time' => time(),
                        'modular' => $modular,
                        'file_name' => 'adminLanguage',
                    ]);
                    sleep(1);
                    if ($data['langKey'] != 0) {
                        //                同步
                        $this->arrWriteFile($languageData, base_path() . '/resources/lang/' . $data['folder'] . "/adminLanguage.php");
                    }
                }


            }
            exit(json_encode(['status' => 1, 'msg' => admin_language('common_addSuccess'), 'url' => url('admin/setting/language')]));
        }

    }

//    删除多语言
    public function delete($id) {

        $file = Language::find($id);

        if (unlink(base_path() . '/resources/lang/' . $file->folder . '/' . $file->file_name . '.php')) {
            Language::destroy($id);
            session_tips(admin_language('common_deleteSuccess'));
        } else {
            session_tips(admin_language('common_deleteFailed'));
        }
        return back();

    }

//    设置状态
    public function status($id) {

        if (Language::where(['id' => $id])->value('status') == 1) {
            if (Language::where(['id' => $id])->update(['status' => 2])) exit(json_encode(['status' => 1, 'msg' => admin_language('common_SetUpSuccessfully')]));
            else exit(json_encode(['status' => 50, 'msg' => admin_language('common_SetupFailed')]));
        } else {
            if (Language::where(['id' => $id])->update(['status' => 1])) exit(json_encode(['status' => 1, 'msg' => admin_language('common_SetUpSuccessfully')]));
            else exit(json_encode(['status' => 50, 'msg' => admin_language('common_SetupFailed')]));
        }

    }

//    删除文件夹
    public function delDirAndFile($path, $delDir = FALSE) {
        $handle = opendir($path);
        if ($handle) {
            while (false !== ($item = readdir($handle))) {
                if ($item != "." && $item != "..")
                    is_dir("$path/$item") ? delDirAndFile("$path/$item", $delDir) : unlink("$path/$item");
            }
            closedir($handle);
            if ($delDir)
                return rmdir($path);
        } else {
            if (file_exists($path)) {
                return unlink($path);
            } else {
                return FALSE;
            }
        }
    }

    //切换默认语言
    public function active($id) {
        $lang = Language::find($id);
        if ($lang->modular == 1) {
            $m = 'HOME_LOCALE';
        } else {
            $m = 'ADMIN_LOCALE';
        }
        modifyEnv([$m => $lang->folder]);
        return back();
    }

    //检测语言包是否存在key
    public function checkLangKeyOnly(Request $request) {

        $lang = Language::where('modular', $request->m)->get();
        if ($request->m == 1) {
            $file_name = 'homeLanguage';
        } else {
            $file_name = 'adminLanguage';
        }
        $t=false;
        foreach ($lang as $l) {
            if (trans($file_name . '.' . $request->key, '', '', $l->folder) != $file_name . '.' . $request->key) {
                $t=true;
            }
        }
        if($t) exit(json_encode(['status'=>2,'msg'=>admin_language('TheLanguagePack')]));
        exit(json_encode(['status'=>1]));

    }

}