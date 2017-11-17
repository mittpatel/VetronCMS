<?php
/**
 * Created by PhpStorm.
 * User: LONG JIN WEN
 * Date: 2017/6/5
 * Time: 11:31
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Intervention\Image\ImageManager;

class CommonController extends Controller {

    function __construct() {

    }


//    获取请求的数据
    public function getRequestData($type, $filter, $addTime = false) {
        $newData = [];
        if ($type == 'post') {
            $data = $_POST;
        } else {
            $data = $_GET;
        }
        foreach ($data as $key => $value) {
            if (!in_array($key, $filter)) {
                $newData[$key] = trim(htmlspecialchars($value));
            }
        }
        if ($addTime) {
            $newData['create_time'] = time();
        }
//      将表单写入session
        session()->put(['request_data' => $newData]);
        return $newData;
    }

//    验证表单是否为空
    public function verificationNull($data, $tips) {
        foreach ($tips as $key => $value) {
            if (!trim($data[$key])) {
                session()->put(['tips' => $tips[$key]]);
                return false;
                break;
            }
        }
        session()->forget('request_data');
        return true;
    }


    public function upLoads($input_file, $path, $allowedtype = array("png", "jpg", "jpeg", "gif",'PNG','JPG','JPEG','GIF')) {
        $files = Input::file($input_file);
        $upload_res = false;
        if (is_array($files)) {
            foreach ($files as $file) {
                if ($file) {
                    if ($file->getError() != 0) {
                        return false;
                    }
                    if (!in_array($file->getClientOriginalExtension(), $allowedtype)) {
                        return false;
                    }
                }
            }
            foreach ($files as $file) {
                if ($file) {
                    if ($file->isValid()) {
                        $filename = date('Ymd') . uniqid() . '.' . $file->getClientOriginalExtension();
                        $file->move(public_path() . '/uploads/' . $path . '', $filename);
                        $upload_res[] = 'uploads/' . $path . '/' . $filename;
                    }
                }
            }
            return $upload_res;
        } else {
            return false;
        }
    }

//    ajax验证字段
    public function ajaxVerificationNull($data, $tips) {
        foreach ($tips as $key => $value) {
            if (!trim($data[$key])) {
                exit(json_encode(['status' => 50, 'msg' => $tips[$key]]));
                break;
            }
        }
        foreach ($data as $k => $l) {
            $data[$k] = htmlspecialchars($l);
        }
        return $data;
    }

    //仅对配置文件
    public function arrInFile($arr_data, $file_name) {
        $path = config_path() . '/' . $file_name . '.php';
        $old_data = require $path;

        if (!is_array($old_data))
            $old_data = [];
        $new_data = var_export(array_merge($old_data, $arr_data), TRUE);
        $fp = fopen($path, "w+");
        if (fwrite($fp, "<?php return " . $new_data . ";")) {
            fclose($fp);
            return true;
        } else {
            fclose($fp);
            return false;
        }
    }

    //
    public function arrWriteFile($arr_data, $path) {
        if (!file_exists($path)) return false;
        $old_data = require $path;
        if (!is_array($old_data))
            $old_data = [];
        $new_data = var_export(array_merge($old_data, $arr_data), TRUE);
        $fp = fopen($path, "w+");
        if (fwrite($fp, "<?php return " . $new_data . ";")) {
            fclose($fp);
            return true;
        } else {
            fclose($fp);
            return false;
        }
    }

//在线资源
    public function onLineFiles() {
//        判断是不是媒体过来的
        $isMedia = $_GET['isMedia'];

//        判断是不是产品选择图集
        $isGallery = $_GET['isGallery'] == 1 ? true : false;

        $upPath = $now = $_GET['now'];
        $isRoot = $_GET['now'] == '/uploads' ? true : false;
        $getDirPath = public_path() . $now;
        $data = $this->getDirAndFileList($getDirPath);
        return view('admin/common/online', compact('data', 'isRoot', 'upPath', 'isMedia', 'isGallery'));
    }

    //获取一级目录下的文件夹和文件
    public function getDirAndFileList($dir) {
        $fileAndDirList = [];
        $dirList = scandir($dir);
        foreach ($dirList as $v) {
            if ($v == '.' || $v == '..') {
                continue;
            }
            $fileAndDirList[] = $dir . '/' . $v;
        }
        return array_reverse($fileAndDirList);
    }

//    ajaxOnLineFiles
    public function ajaxOnLineFiles() {
        $upload = $this->upLoads('FileData', removeUploadStr($_GET['path']));
//        exit(json_encode([removeUploadStr($_GET['path'])]));
        if ($upload) {
            if (removeUploadStr($_GET['path']) == '') {
                $path = explode('//', $upload[0])[0] . '/' . explode('//', $upload[0])[1];
            } else {
                $path = $upload[0];
            }
            $this->cutPictures($path, $_GET);
            exit(json_encode(['status' => 1, 'msg' => '上传成功', 'path' => $upload[0], 'nowPath' => $_GET['path'], 'url' => asset($upload[0])]));
        } else {
            exit(json_encode(['status' => 2, 'msg' => '上传失败']));
        }
    }

    public function cutPictures($path, $data) {
        /*
             x1:120
             y1:92
             x2:596
             y2:364
             ww:476
             hh:272
             yw:2560
             yh:1440
             aw:812
             ah:457
         * */
        if ($data['ww'] == '') return true;
//       比例
        $b = round($data['yw'] / $data['aw'], 8);
        $manager = new ImageManager();
        $image = $manager->make(public_path() . '/' . $path);
        $image->crop(round($data['ww'] * $b), round($data['hh'] * $b), round($data['x1'] * $b), round($data['y1'] * $b))
            ->save(public_path() . '/' . $path);
    }

    public function deleteDir($path, $delDir = true) {

        $handle = opendir($path);
        if ($handle) {
            while (false !== ($item = readdir($handle))) {
                if ($item != "." && $item != "..")
                    is_dir("$path/$item") ? $this->deleteDir("$path/$item", $delDir) : unlink("$path/$item");
            }
            closedir($handle);
            if ($delDir) return rmdir($path);
        } else {
            if (file_exists($path))
                return unlink($path);
            else return false;
        }

    }

    protected function addLangData($lang, $data, $m) {
        if ($m == 1) {
            $m = 'homeLanguage.php';
        } else {
            $m = 'adminLanguage.php';
        }
        $this->arrWriteFile($data, base_path() . '/resources/lang/' . $lang . '/' . $m);
    }
    public function downloadServerLoading(){
        return '下载中';
    }


}