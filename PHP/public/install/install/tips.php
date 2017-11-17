<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>VetronCMS</title>
    <link rel="stylesheet" href="../install/scripts/app.css">
    <script src="../install/scripts/jquery.min.js"></script>
    <script src="../install/scripts/app.js"></script>
</head>
<body>
<div class="header">
    <div class="header-content">
        <div class="logo">
            VetronCms
        </div>
        <div class="logo-text">
            提示
        </div>
    </div>
</div>
<div style="width: 1200px;margin: 50px auto;text-align: center;font-size: 18px;">
    您已经安装过Vetron Cms
    <br>
    重新安装请删除<b><?php echo dirname(dirname(__DIR__)) . '/install.lock'; ?></b>文件
    <br>
    <a href="../../">返回首页</a>
</div>

<div class="footer">
    VetronCms 深圳维畅科技有限公司 1.0 ©2016-2017
</div>
</body>
</html>