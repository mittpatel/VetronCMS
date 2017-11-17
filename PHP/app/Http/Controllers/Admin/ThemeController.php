<?php
/**
 * Created by PhpStorm.
 * User: LONG JIN WEN
 * Date: 2017/6/15
 * Time: 14:18
 */

namespace App\Http\Controllers\Admin;

use App\Http\Model\Admin\Theme;
use Illuminate\Http\Request;
use wapmorgan\UnifiedArchive\UnifiedArchive;
class ThemeController extends CommonController {
    /*
     * 首页
     * */
    public function theme() {
        session(['breadcrumb' => ['url' => 'admin/setting/theme', 'modular' => admin_language('theme_theme'), 'action' => admin_language('common_lists')]]);

        $themeList = $this->getHomePage(config('view.paths')[0] . '/home');
        foreach ($themeList as $t) {
            $t->status = Theme::where('path', $t->onlyFolder)->value('status');
        }


//        dd($dData);
        return view('admin/theme/theme', compact('themeList', 'dData'), ['other' => ['navActive' => 'setting', 'navActiveSon' => 'settingTheme']]);

    }


    /*
     * 主题添加（上传）
     * */
    public function add(Request $request) {
        if ($request->isMethod('get')) {
            return view('admin/theme/add', compact(''), ['other' => ['navActive' => 'setting', 'navActiveSon' => 'settingTheme']]);

        }
        if ($request->isMethod('post')) {
            set_time_limit(0);

            $data = $this->getRequestData('post', ['_token'], true);


            $tips = [
                'language_key' => '名称不能为空',
                'folder' => '存放目录不能为空',
            ];
            if ($_FILES['template']['size'][0] == 0) {
                session_tips('请上传模版压缩包');
                return back();
            }
            if ($_FILES['view']['size'][0] == 0) {
                session_tips('请上传预览图');
                return back();
            }

            if ($this->verificationNull($data, $tips)) {
//                创建文件夹
                if (!is_dir(config('view.paths')[0] . '/home/' . $data['folder'])) {
                    $template = $this->upLoads('template', 'theme', ['zip']);
                    if (!$template) {
                        session_tips('模板上传失败');
                        return back();
                    }
                    $view = $this->upLoads('view', 'theme');
                    if (!$view) {
                        session_tips('预览图上传失败');
                        return back();
                    }
                    mkdir(config('view.paths')[0] . '/home/' . $data['folder'], 0777);
                    sleep(1);
//                    $this->unzip();
                    $zip = new \ZipArchive;//新建一个ZipArchive的对象
                    /*
                    通过ZipArchive的对象处理zip文件
                    $zip->open这个方法的参数表示处理的zip文件名。
                    如果对zip文件对象操作成功，$zip->open这个方法会返回TRUE
                    */
                    if ($zip->open(public_path() . '/' . $template[0]) === TRUE) {
                        $zip->extractTo(public_path() . '/uploads/dsadsad');//假设解压缩到在当前路径下images文件夹的子文件夹php
                        $zip->close();//关闭处理的zip文件
                    } else {
                        dd(0);
                    }
                } else {
                    session_tips('存放目录已经存在');
                    return back();
                }

            } else {
                return back();
            }
        }
    }

    /*
     * 获取前台主题的列表
     * */
    private function getHomePage($path) {

        $files = scandir($path);
        $return = [];
        foreach ($files as $k => $value) {
            if ($value == '.' || $value == '..') {
                continue;
            }
            /*$return[$value] = $this->isDirHaveConfig($path . '/' . $value);
            $return[$value]->onlyFolder = $value;*/
            $theme = $this->isDirHaveConfig($path . '/' . $value);
            if (!$theme) {
                continue;
            }
            $return[$value] = $theme;
            $return[$value]->onlyFolder = $value;
            unset($theme);
        }


        return $return;
    }

    /*
     * 返回配置文件的数据
     * */
    private function isDirHaveConfig($path) {
        /*$files = scandir($path);
        foreach ($files as $value) {
            if ($value == config('config.themeConfigFileName')) {
                return json_decode(file_get_contents($path . '/' . $value));
            }
        }*/
        //20170804 更新
        //存在配置文件时直接返回json
        $file = $path . '/' . config('config.themeConfigFileName');
        if (is_file($file)) {
            $json = json_decode(file_get_contents($file));
            if (!$json) {
                return FALSE;
            }
            return $json;
        }
    }


    /*
     * 操作(启用，禁用，安装，卸载)
	 * 0 => 未安装
	 * 1 => 启用
	 * 2 => 已安装
     * */
    public function action(Request $request) {

        $path = config('view.paths')[0] . '/home/' . $request->theme . '/' . config('config.themeConfigFileName');
        $jsonData = json_decode(file_get_contents($path));
        if ($request->action == 'install') {
            $status = 2;
        } elseif ($request->action == 'enable') {
            $this->setTheme($request->theme);
            $status = 1;
        } elseif ($request->action == 'uninstall') {
            $status = 0;

        } elseif ($request->action == 'delete') {
            $this->deleteDir(config('view.paths')[0] . '/home/' . $request->theme, TRUE);
            return back();
        }
//        dd($status);
        if ($status == 0) {
            Theme::where('path', $request->theme)->delete();
        } else {
            $this->setDstatus($path, $status);
        }
        $jsonData->status = $status;
        file_put_contents($path, json_encode($jsonData));

        return back();
    }

    private function setDstatus($path, $status) {
        $js = json_decode(file_get_contents($path));
        $data = Theme::where('path', $js->config->themeRootPath)->first();
        if (!$data) {
            //如果不存在则安装
            Theme::create([
                'path' => $js->config->themeRootPath,
                'name' => $js->themeInformation->name,
                'status' => $status,
            ]);
        } else {
            Theme::where('id', '>', 0)->update(['status' => $status == 1 ? 2 : 1]);
            $data->status = $status;
            $data->save();
        }

    }

    //设置主题
    private function setTheme($theme) {
        $data['CMS_THEME'] = $theme;

        $old = env('CMS_THEME');

        $path = config('view.paths')[0] . '/home/' . $old . '/' . config('config.themeConfigFileName');
        $jsonData = json_decode(file_get_contents($path));
        $jsonData->status = 2;

        file_put_contents($path, json_encode($jsonData));

        if (!modifyEnv($data)) {
            $jsonData->status = 1;
            file_put_contents($path, json_encode($jsonData));
        };
        return TRUE;
    }

    //清空缓存
    public function delCache() {
        $this->deleteDir(config('view.compiled'), false);
        return back();
    }

    //获取主题
    private function getTheme() {
        return env('CMS_THEME', 'default');
    }

    /*
     * 设置所有状态
     * */
    private function setAllStatus($status) {
        $files = scandir(config('view.paths')[0] . '/home');
        foreach ($files as $file) {
            if ($file == '.' || $file == '..') continue;
            $tmpJson = json_decode(file_get_contents(config('view.paths')[0] . '/home/' . $file . '/' . config('config.themeConfigFileName')));
            if (isset($tmpJson->status)) {
                $tmpJson->status = $status;
                file_put_contents(config('view.paths')[0] . '/home/' . $file . '/' . config('config.themeConfigFileName'), json_encode($tmpJson));
            }
        }
        sleep(1);
    }

    /*
     *设置单个主题的状态
     * */
    private function setOneStatus($folder, $status) {
        $tmpJson = json_decode(file_get_contents(config('view.paths')[0] . '/home/' . $folder . '/' . config('config.themeConfigFileName')));
        $tmpJson->status = $status;
        file_put_contents(config('view.paths')[0] . '/home/' . $folder . '/' . config('config.themeConfigFileName'), json_encode($tmpJson));
    }


    /*
     * 获取当前启用主题
     * */
    public static function getActiveTheme() {
        /*$files = scandir(config('view.paths')[0] . '/home');
        foreach ($files as $file) {
            if ($file == '.' || $file == '..') continue;
            $tmpJson = json_decode(file_get_contents(config('view.paths')[0] . '/home/' . $file . '/' . config('config.themeConfigFileName')));
            if ($tmpJson->status == 1) return $file;

        }*/
        return env('CMS_THEME', 'default');
    }

    /*
     * 获取一个主题内所有文件
     * */
    public function themeFileList($theme) {
        session(['breadcrumb' => ['url' => 'admin/setting/theme', 'modular' => admin_language('theme_theme'), 'action' => admin_language('common_lists')]]);
        if ($_GET['path'] == '/' || !$_GET['path']) $nowPath = '';
        else $nowPath = $_GET['path'];
        $path = config('view.paths')[0] . '/home/' . $theme . $nowPath;
        //允许编辑的文件类型
        $allowEditType = config('config.themeAllowEditFileType');

        $tmp = scandir($path);

        $files = [];
        if ($_GET['path'] == '/' || !$_GET['path']) $isRoot = true;
        else $isRoot = false;
        $upPath = '/' . getUpPath($_GET['path']);
        foreach ($tmp as $file) {
            if ($file == '.' || $file == '..' || $file == 'config.json') continue;
            //判断是否是文件夹
            if (is_dir($path . '/' . $file)) {
                $files[] = [
                    'name' => $file,
                    'suffix' => admin_language('theme_dir'),
                    'isDir' => 1,
                    'path' => $nowPath . '/' . $file,
                    'allowEdit' => true
                ];
            } else {

                $files[] = [
                    'name' => $file,
                    //取后缀
                    'suffix' => getFormArrLastStr($file, '.'),
                    'time' => date('Y-m-d H:i:s', filemtime($path . '/' . $file)),
                    'isDir' => 2,
                    'allowEdit' => in_array(getFormArrLastStr($file, '.'), $allowEditType) ? true : false
                ];
            }
        }

        rsort($files);
        return view('admin/theme/themeFileList', compact('files', 'theme', 'isRoot', 'upPath', 'nowPath'), ['other' => ['navActive' => 'setting', 'navActiveSon' => 'settingTheme']]);


    }

    /*
     * 更改文件夹名称
     * */
    public function changeFolderName() {

        $path = config('view.paths')[0] . '/home/' . $_GET['theme'] . $_GET['path'];
        $tmp = getUpPath($path);

        if (is_dir($path)) {
            if (rename($path, $tmp . '/' . $_GET['name'])) {
                exit(json_encode(['status' => 1, 'msg' => admin_language('common_updateSuccess')]));
            } else {
                exit(json_encode(['status' => 50, 'msg' => admin_language('common_updateFailed')]));
            }
        } else {
            exit(json_encode(['status' => 50, 'msg' => admin_language('common_updateFailed')]));
        }

    }

    /*
     * 更改文件内容
     * */
    public function changeFile(Request $request) {
        if ($request->isMethod('get')) {
            $path = config('view.paths')[0] . '/home/' . $request->theme . $request->path . '/' . $request->file;
            $content = file_get_contents($path);
            return view('admin/theme/changeFile', compact('content', 'path'), ['other' => ['navActive' => 'setting', 'navActiveSon' => 'settingTheme']]);

        }
        if ($request->isMethod('post')) {
            if (file_put_contents($request->path, $request->contentText)) return back()->with('tips', '更新成功');
            return back()->with('tips', '更新失败');
        }
    }

    /*
     * 删除文件和文件夹
     * */
    public function changeFileDelete(Request $request) {
        $file = config('view.paths')[0] . '/home/' . $request->s;
        if (is_dir($file)) {
            $this->deleteDir($file);
        } else {
            unlink($file);
        }
        return back();
    }


    public function create_dirs($path) {
        if (!is_dir($path)) {
            $directory_path = "";
            $directories = explode("/", $path);
            array_pop($directories);

            foreach ($directories as $directory) {
                $directory_path .= $directory . "/";
                if (!is_dir($directory_path)) {
                    mkdir($directory_path);
                    chmod($directory_path, 0777);
                }
            }
        }
    }

    public function iframeStore(Request $request) {

        //从外部链接安装
        if ($request->has('http')) {
            $iframeUrl = url('admin/theme/server/download?download=' . $request->download . '&info=' . $request->info);
        } else {

            //插件主题服务器的域名

            $iframeUrl = CMS_DEVELOPER . '?domain=' . urlencode(trim(url('/'), '/'));

        }


        session(['breadcrumb' => ['url' => '', 'modular' => admin_language('theme_theme'), 'action' => admin_language('common_lists')]]);
        return view('admin/theme/iframe', compact('root', 'isHttp', 'iframeUrl'), ['other' => ['navActive' => 'setting', 'navActiveSon' => 'settingTheme']]);


        //插件主题服务器的域名
//        $root = 'http://10.68.100.102/SZVETRON-036-VETRONCMS-DEVELOPER/public';
//        session(['breadcrumb' => ['url' => '', 'modular' => admin_language('theme_theme'), 'action' => admin_language('common_lists')]]);
//        return view('admin/theme/iframe', compact('pluginList', 'root'), ['other' => ['navActive' => 'setting', 'navActiveSon' => 'settingTheme']]);

    }

    //主题下载
    public function serverDownload(Request $request) {
        if ($request->isMethod('get')) {
            session()->put(['serverDownload' => ['download' => $request->download, 'info' => $request->info]]);
            $serverDownload = session()->get('serverDownload');

            return view('admin/common/iframeLoading',compact('serverDownload'));
        }
        if ($request->isMethod('post')) {

            $serverDownload = session()->get('serverDownload');

            $info = json_decode(urldecode($serverDownload['info']));

            if ($info->hasfile == 1) {
                $tmpFileName = base_path() . '/storage/framework/tmp/' . time() . mt_rand(10000000, 99999999) . '.zip';
                ob_start();
                readfile(urldecode($serverDownload['download']));

                $file = ob_get_contents();
                ob_end_clean();
                $fp = fopen($tmpFileName, "w");
                $res = fwrite($fp, $file);
                fclose($fp);

                if ($res == $info->size) {
                    //下载完成
                    //解压文件
                    $n = new UnifiedArchive($tmpFileName, 'zip');
                    $res = $n->extractNode(public_path() . '/template/home/' . $info->onlyName);
                    //占用文件无法删除
//                dd(unlink($tmpFileName));
                    return response(['status' => 1, 'msg' => admin_language('DownloadCompleted'),'url'=>url('admin/setting/theme')]);
                } else {
                    //下载失败
                    return response(['status' => 1, 'msg' => admin_language('DownloadFailed')], 422);

                }
            } else {
                //文件不存在

                return response(['status' => 1, 'msg' => admin_language('FileDoesNotExist')], 422);
            }

        }
    }


}