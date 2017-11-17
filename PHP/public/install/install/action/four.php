<?php
include 'common/header.php';
if (!isset($_GET['status'])) {
    header("location:one.php");
}
?>
    <div class="main-content">
        <div class="content-text ok">
            <h1>
                安装完成，欢迎使用！
            </h1>
            <hr class="cu">
            <p>欢迎使用VetronCMS！希望VetronCMS能够为您的企业带来客户并创造价值！</p>
            <p>基于安全考虑，删除安装文件，以防止再次安装而覆盖数据。</p>            
            <a style="margin-left: 10px;" href="../action.php?action=home&status=ok">进入网站首页</a>
            <a href="../action.php?action=admin&status=ok">进入后台</a>
        </div>
    </div>
    <script>
        document.onkeydown = function () {
            if (event.keyCode == 116) {
                event.keyCode = 0;
                event.cancelBubble = true;
                return false;
            }
        }
        document.oncontextmenu = function () {
            return false;
        }
      
    </script>
<?php
include 'common/footer.php';
?>