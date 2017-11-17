<?php require 'functions.php'; ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>VetronCMS</title>
    <link rel="stylesheet" href="../scripts/app.css">
    <script src="../scripts/jquery.min.js"></script>
    <script src="../scripts/app.js"></script>
</head>
<body>
<div class="header">
    <div class="header-content">
        <div class="logo">
            VetronCMS
        </div>
        <div class="logo-text">
            全新安装
        </div>
    </div>
</div>
<div class="install-order">
    <div class="
    <?php if ($_GET['active'] == 'one') {
        echo 'active';
    } ?>
    "><span>1</span>阅读使用协议
    </div>
    <div class="
    <?php if ($_GET['active'] == 'two') {
        echo 'active';
    } ?>
    "><span>2</span>系统环境检测
    </div>
    <div class="
    <?php if ($_GET['active'] == 'three') {
        echo 'active';
    } ?>
    "><span>3</span>数据库设置
    </div>

    <div class="
    <?php if ($_GET['active'] == 'four') {
        echo 'active';
    } ?>
    "><span>4</span>安装完成
    </div>
</div>