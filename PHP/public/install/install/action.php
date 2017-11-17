<?php
/**
 * Created by PhpStorm.
 * User: LONG JIN WEN
 * Date: 2017/7/5
 * Time: 15:31
 */

require 'Init.php';
$init = new Init();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action'])) {
        $action = $_POST['action'];

        //检测mysql连接
        if ($action == 'checkMysql') {
            if ($init->checkMysql($_POST['host'], $_POST['name'], $_POST['password'], $_POST['port'])) {
                echo '<span style="color: green;">连接成功</span>';
                exit();
            } else {
                echo '<span style="color: red;">连接失败</span>';
                exit();
            }
        }
        if ($action == 'install') {
            sleep(2);


            $init->install($_POST);

        }


    }
}
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['action'])) {
        $action = $_GET['action'];
        if ($_GET['status'] == 'ok') {
            if ($action == 'home') {
                echo '<script>parent.ok("")</script>';
            } else if ($action == 'admin') {
                echo '<script>parent.ok("admin")</script>';
            } else if ($action == 'delete') {

                $this->deleteInstall();
            }
        }
    }
}
