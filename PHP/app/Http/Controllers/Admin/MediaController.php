<?php
/**
 * Created by PhpStorm.
 * User: LONG JIN WEN
 * Date: 2017/6/19
 * Time: 16:10
 */

namespace App\Http\Controllers\Admin;


class MediaController extends CommonController {
    public function mediaLists() {

        session(['breadcrumb' => ['url' => 'media', 'modular' => admin_language('media_media'), 'action' => admin_language('common_lists')]]);
        $upPath = $now = $_GET['now'] ? $_GET['now'] : '/uploads';
        $isRoot = !$_GET['now'] ? true : false;
        $getDirPath = public_path() . $now;
        $data = $this->getDirAndFileList($getDirPath);


        return view('admin/media/mediaLists', compact('data', 'isRoot', 'upPath'), ['other' => ['navActive' => 'media', 'navActiveSon' => 'mediaLists']]);
    }

    public function ajaxCreateFolder() {
        $nowPath = $_GET['nowPath'] ? $_GET['nowPath'] : '/uploads';
        $getDirPath = public_path() . $nowPath;
        if (!is_dir($getDirPath . '/' . $_GET['text'])) {
            if (mkdir($getDirPath . '/' . $_GET['text'], 0777))
                exit(json_encode(['status' => 1, 'msg' => admin_language('common_addSuccess')]));
            else
                exit(json_encode(['status' => 50, 'msg' => admin_language('common_addFailed')]));

        } else {
            exit(json_encode(['status' => 50, 'msg' => admin_language('media_TheFolderAlreadyExists')]));
        }
    }
}


