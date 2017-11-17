<?php
/**
 * Created by PhpStorm.
 * User: LONG JIN WEN
 * Date: 2017/8/11
 * Time: 15:48
 */

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

class UploadController extends CommonController {
    /*
     * 获取列表
     * */
    public function getAllList(Request $request) {
        $nowPath = $request->nowPath;
        $data = $this->formPathGetData($nowPath);
        $isRoot = $data['isRoot'];
        $upPath=$data['upPath'];
        $nowPath=$data['nowPath'];
        $data = $data['data'];
//        dd($data);
        /*
         *     "type" => "file"
                "suffix" => "txt"
                "assetUrl" => "http://127.0.0.1/SZVETRON-027-VETRONCMS_V2/public/uploads/re.txt"
                "absolutely" => "D:\phpStudy\WWW\SZVETRON-027-VETRONCMS_V2\public/uploads/re.txt"
                "relative" => "/uploads/re.txt"


                "type" => "dir"
                "pathName" => "logo"
                "upPath" => "/uploads"
                "absolutely" => "D:\phpStudy\WWW\SZVETRON-027-VETRONCMS_V2\public/uploads/logo"
                "relative" => "/uploads/logo"
         *
         *
         * */
        return view('admin/upload/uploadAll', compact('data','isRoot','upPath','nowPath'));
    }
    public function getPathList(Request $request){
        $nowPath = $request->nowPath;
        $data = $this->formPathGetData($nowPath);
        $isRoot = $data['isRoot'];
        $upPath=$data['upPath'];
        $nowPath=$data['nowPath'];
        $data = $data['data'];
        return view('admin/upload/path', compact('data','isRoot','upPath','nowPath'));
    }

    /*
     * 创建文件夹
     * */
    public function createFolder(Request $request){

        if ($request->nowPath == '/' || $request->nowPath == '') $request->nowPath = '/uploads';

        $getDirPath = public_path() .  $request->nowPath;
        if (!is_dir($getDirPath . '/' . $request->text)) {
            if (mkdir($getDirPath . '/' . $request->text, 0777))
                exit(json_encode(['status' => 1, 'msg' => admin_language('common_addSuccess')]));
            else
                exit(json_encode(['status' => 50, 'msg' => admin_language('common_addFailed')]));
        } else {
            exit(json_encode(['status' => 50, 'msg' => admin_language('media_TheFolderAlreadyExists')]));
        }
    }
    /*
     * 通过路径返回所有信息
     * */
    private function formPathGetData($nowPath) {
        if ($nowPath == '/' || $nowPath == '') $nowPath = '/uploads';
        $yNowpath=$nowPath;
        $nowPath = public_path() . $nowPath;

        $data = $this->getDirAndFileList($nowPath);
        foreach ($data as $k => &$d) {
            $tmp = $d;
            $d = [];
            if (is_dir($tmp)) {
                $d['type'] = 'dir';
                $d['dirName'] = getFormArrLastStr($tmp, '/');

                $d['upPath'] = '/' . getUpPath(substr($tmp, strlen(public_path())));
            } else {

                $d['type'] = 'file';
                $d['suffix'] = getFormArrLastStr($tmp, '.');
                $d['assetUrl'] = asset(substr($tmp, strlen(public_path())));
                $d['fileName']=getFormArrLastStr($tmp, '/');
            }
            $d['absolutely'] = $tmp;
            $d['relative'] = substr($tmp, strlen(public_path()));
        }
        /*判断是否是根目录*/
        if (substr($nowPath, strlen(public_path())) == '/uploads') {
            $isRoot = true;
        } else {
            $isRoot = false;
        }
        return ['data' => $data, 'isRoot' => $isRoot,'upPath'=>'/' . getUpPath(substr($nowPath, strlen(public_path()))),'nowPath'=>$yNowpath];
    }

    public function deleteFileAdir(Request $request){
        if(empty($request->nowPath)){
            exit(json_encode(['status' => 50, 'msg' => admin_language('common_deleteFailed')]));
        }

        if($this->deleteDir(public_path().$request->nowPath)){
            exit(json_encode(['status' => 1, 'msg' => admin_language('common_deleteSuccess')]));
        }
        exit(json_encode(['status' => 50, 'msg' => admin_language('common_deleteFailed')]));
    }

}