<?php

/**
 * Created by PhpStorm.
 * User: LONG JIN WEN
 * Date: 2017/7/5
 * Time: 15:29
 */
class Init {
    public $host;
    public $user;
    public $password;
    public $bd;

    public function __construct() {

    }


    public function checkMysql($host, $user, $password, $port) {
        $conn = @mysqli_connect($host, $user, $password, null, $port);
        if ($conn) {
            return true;
        } else {
            return false;
        }
    }

    public function install($data) {
        set_time_limit(0);

        $conn = @mysqli_connect($data['host'], $data['db_user'], $data['db_password'], null, $data['port']);
        if (!$conn) {
            exit(json_encode(['status' => 50, 'msg' => '数据库连接失败']));
        }

        if (!$this->unDatabase($conn, $data['db_name'])) {
            exit(json_encode(['status' => 50, 'msg' => '数据库创建失败']));
        }
        if (!$this->createDatabase($conn, $data['db_name'])) {
            exit(json_encode(['status' => 50, 'msg' => '数据库创建失败']));
        }

        $db = mysqli_connect($data['host'], $data['db_user'], $data['db_password'], $data['db_name'], $data['port']);
        if (!file_exists(__DIR__ . '/vetroncms.sql')) {
            exit(json_encode(['status' => 50, 'msg' => 'sql文件被损坏，请重新下载！']));
        }

        $sql = file_get_contents(__DIR__ . '/vetroncms.sql');
        $sqlArr = array_filter(explode(";", trim($sql)));
        $error = true;
        foreach ($sqlArr as $sqlOne) {
            $val = $sqlOne . ";";
            if (!mysqli_query($db, trim($val))) {
                $error = false;
            }
        }

        if (!$error) {
            exit(json_encode(['status' => 50, 'msg' => '<span style="color: green">数据插入失败,请重试.</span>']));
        }

        if (!$this->insertAdmin($db, $data)) {
            exit(json_encode(['status' => 50, 'msg' => '<span style="color: green">安装失败,请重试.</span>']));
        }
        if (!$this->installOk()) {
            exit(json_encode(['status' => 50, 'msg' => '<span style="color: green">安装失败,请重试.</span>']));
        }
        if (!$this->setMysql($data)) {
            exit(json_encode(['status' => 50, 'msg' => '<span style="color: green">安装失败,请重试.</span>']));
        }
        exit(json_encode(['status' => 1, 'msg' => '<span style="color: green">安装成功,正在跳转...</span>']));

    }

    public function unDatabase($conn, $name) {
        if (mysqli_select_db($conn, $name)) {
            if (!mysqli_query($conn, 'DROP DATABASE ' . $name)) {
                $this->unDatabase($conn, $name);
            } else {
                return true;
            }
        } else {
            return true;
        }
    }

    public function createDatabase($conn, $name) {
        if (!mysqli_query($conn, 'CREATE DATABASE `' . $name . '` ')) {
            $this->createDatabase($conn, $name);
        } else {
            return true;
        }
    }

    public function insertAdmin($db, $data) {

        $password = md5($data['admin_password'] . 'vetron');
        $sql = "INSERT INTO `vt_admin_user` VALUES (1, '" . $data['admin_name'] . "','" . $password . "' , '" . "uploads/admin/defaultHeader.png" . "', '" . $data['admin_email'] . "', '" . $data['admin_phone'] . "', null, null, null, " . time() . ", '0', '1', '0')";
        if (mysqli_query($db, $sql)) {
            return true;
        } else {
            $this->insertAdmin($db,$data);
        }
    }

    public function installOk() {

        if (fopen(__DIR__ . '../../../install.lock', "w")) {
            return true;
        } else {
            $this->installOk();
        }
    }

    public function setMysql($data) {
        $dbData = [
            'DB_HOST' => $data['host'],
            'DB_PORT' => $data['port'],
            'DB_DATABASE' => $data['db_name'],
            'DB_USERNAME' => $data['db_user'],
            'DB_PASSWORD' => $data['db_password'],
            'INSTALL_TIME' => time()
        ];
        if (!$this->modifyEnv($dbData)) {
            return false;
        }
        return true;
    }

    public function modifyEnv($data) {
        $envPath = dirname(dirname(dirname(__DIR__))) . DIRECTORY_SEPARATOR . '.env';
        $str='';
        foreach (file($envPath) as $key => $value) {
            $t = explode('=', $value);
            if(empty(trim($value))) continue;
            $new[trim($t[0])] = trim($t[1]);
            foreach ($data as $k => $v) {
                if (trim($t[0]) == trim($k)) {
                    $new[$t[0]] = trim($v);
                }
            }
        }
        foreach ($new as $k=>$v){
            $str.=$k."=".$v."\r\n";
        }
        return file_put_contents($envPath, $str);
    }

    public function arrInFile($configPath, $appendArray) {
        set_time_limit(0);
        if (!file_exists($configPath)) return false;
        $oldArrayData = require $configPath;
        if (!is_array($oldArrayData)) $oldArrayData = [];
        $newData = var_export(array_merge($oldArrayData, $appendArray), true);
        return file_put_contents($configPath, "<?php return " . $newData . ";");
    }

}