<?php
/**
 * Created by PhpStorm.
 * User: LONG JIN WEN
 * Date: 2017/6/26
 * Time: 15:53
 */

namespace App\Http\Controllers\Admin;

use App\Http\Model\Admin\PluginOptions;
use App\Services\Repositories\OptionRepository;
use Illuminate\Http\Request;
use App\Services\PluginManager;
use wapmorgan\UnifiedArchive\UnifiedArchive;

class PluginController extends CommonController {
    public function pluginList(PluginManager $plugins) {

        $allplugins = $plugins->getPlugins();
        foreach ($allplugins as $plugin) {
            if ($plugin->isInstalled()) {
                if ($plugin->isEnabled()) {
                    $pluginList['enabled'][] = $plugin;
                } else {
                    $pluginList['unenabled'][] = $plugin;
                }
            } else {
                $pluginList['uninstalled'][] = $plugin;
            }
        }
        session(['breadcrumb' => ['url' => '', 'modular' => admin_language('menu_plugin'), 'action' => admin_language('common_lists')]]);
        return view('admin/plugin/pluginList', compact('pluginList'), ['other' => ['navActive' => 'plugin', 'navActiveSon' => 'plugin']]);
    }

    public function action(PluginManager $plugins, OptionRepository $optionRepository, $method, $name) {
        if (!$name) return back();
        $result = false;

        $msg = admin_language('plugin_ParameterErrorP');
        switch ($method) {
            case 'install':
                //判断是否已经安装过
                if ($optionRepository->has($name)) {
                    $msg = admin_language('plugin_ThePluginIsAlre');
                } else {
                    $install = $plugins->install($name);
                    if (count($install) == 1 || (isset($install[0]) && $install[0] == true)) {
                        $result = $optionRepository->doSetOption($name, 2, 1);
                        if ($result) $msg = admin_language('plugin_InstallationSuc');
                        else $msg = admin_language('plugin_InstallationErr');
                    }
                }
                break;
            case 'enable':
                $enable = $plugins->enable($name);
                if (count($enable) == 1 || (isset($enable[0]) && $enable[0] == true)) {
                    $result = $optionRepository->doSetOption($name, 2);
                    if ($result) $msg = admin_language('plugin_EnableSuccess');
                    else  $msg = admin_language('plugin_ErrorEnabledPle');
                }
                break;
            case 'disable':
                $disable = $plugins->disable($name);
                if (count($disable) == 1 || (isset($disable[0]) && $disable[0] == true)) {
                    $result = $optionRepository->doSetOption($name, 1);
                    if ($result) $msg = admin_language('plugin_DisableSuccess');
                    else  $msg = admin_language('plugin_DisableErrorsPl');
                }
                break;
            case 'uninstall':
                $plugins->uninstall($name);
                $result = $optionRepository->delete($name);
                if ($result) $msg = admin_language('plugin_UninstallSucces');
                else  $msg = admin_language('plugin_UninstallErrorP');
                break;
            case 'update':
                break;
            case 'score':
                return redirect('http://www.sogou.com');
                break;
            case 'report':
                return redirect('http://www.sogou.com');
                break;
        }

        return back()->with('tips', $msg);
    }

    public function iframeStore(Request $request) {
        //从外部链接安装
        if ($request->has('http')) {
            $iframeUrl=url('admin/plugin/server/download?download='.$request->download.'&info='.$request->info);
        }else{

            $iframeUrl=CMS_DEVELOPER.'?domain='.urlencode(trim(url('/'),'/'));

        }


        session(['breadcrumb' => ['url' => '', 'modular' => admin_language('menu_plugin'), 'action' => admin_language('common_lists')]]);
        return view('admin/plugin/iframe', compact('root','isHttp','iframeUrl'), ['other' => ['navActive' => 'plugin', 'navActiveSon' => 'plugin']]);

    }

    //插件下载
    public function serverDownload(Request $request) {
        if ($request->isMethod('get')) {

            session()->put(['serverDownload' => ['download' => $request->download, 'info' => $request->info]]);
            $serverDownload = session()->get('serverDownload');
            return view('admin/common/iframeLoading',compact('serverDownload'));
        }
        if ($request->isMethod('post')) {
            /*
            * {#366 ▼
                 +"size": 103928
                 +"onlyName": "2017"
                 +"id": 60
                 +"hasfile": 1
               }
            * */
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
                    $res = $n->extractNode(public_path() . '/plugins/' . $info->onlyName);
                    //占用文件无法删除
//                dd(unlink($tmpFileName));
                    return response(['status' => 1, 'msg' => admin_language('DownloadCompleted'),'url'=>url('admin/plugin')]);
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