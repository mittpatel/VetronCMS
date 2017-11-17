<?php
include 'common/header.php';
$status = true;
?>

<div class="main-content">
    <div class="content-text">
        <h1>
            环境检测
        </h1>
        <hr class="cu">
    </div>
    <div>

        <div class="res" style="">
            <span class="res-text" style="">检测php版本和mysql信息</span>
            <div class="res-list">
                <span>php版本</span><span>
                    <?php
                    if (PHP_VERSION > '5.6') {
                        echo '<span style="color: green">支持</span>';
                    } else {
                        $status = false;
                        echo '<span style="color: red">版本需要在5.6以上</span>';
                    }
                    ?>
                </span>
            </div>

            <div class="res-list">
                <span>mysql支持</span><span>
                    <?php
                    if (function_exists("mysql_close") == 1) {
                        echo '<span style="color: green">支持</span>';
                    } else {
                        $status = false;
                        echo '<span style="color: red">不支持</span>';
                    }
                    ?>
                </span>
            </div>
        </div>


        <div class="res" style="">
            <span class="res-text" style="">文件和目录读写权限</span>
            <?php
            //返回到安装根目录
            $path = dirname(dirname(dirname(dirname(dirname(__FILE__)))));
            $fileList = scandir($path);
            foreach ($fileList as $file) {
                if ($file == '.' || $file == '..') continue;
                $pathS = $path . '/' . $file;
                if (is_dir($pathS)) {
                    if (is_readable($pathS) && is_writable($pathS)) {

                        echo '<div class="res-list"><span>' . $file . '(文件夹)</span><span style="color: green">正常</span></div>';
                    } else {
                        $status = false;
                        echo '<div class="res-list"><span>' . $file . '(文件夹)</span><span style="color: red">错误</span></div>';
                    }
                } else {
                    if (is_readable($pathS) && is_writable($pathS)) {
                        echo '<div class="res-list"><span>' . $file . '(文件)</span><span style="color: green">正常</span></div>';
                    } else {
                        $status = false;
                        echo '<div class="res-list"><span>' . $file . '(文件)</span><span style="color: red">错误</span></div>';
                    }
                }
            }
            ?>
        </div>
        <div class="res-res">
            <?php
            if ($status) {
                echo '<span style="color: green;font-size: 18px;">检测通过</span>';
            } else {
                echo '<span style="color: red;font-size: 18px;">检测不通过，请查看检测列表</span>';
            }
            ?>

        </div>
    </div>
</div>
<div style="text-align: center">
    <button onclick="window.location.reload()" style="" href="javascript:;" class="button button-s">
        重新检测
    </button>
    <button href="" onclick="window.location='three.php?active=three&status=<?php echo $status; ?>'"
            class="button button-s next-a">
        下一步
    </button>
</div>

<?php
include 'common/footer.php'
?>
