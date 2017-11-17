<?php

if (!file_exists(dirname(__DIR__) . '/install.lock')) {
    $host = str_replace('/index.php', '', $_SERVER['PHP_SELF']);
    header("Location: " . rtrim($host, '/') . "/install/index.php");
    exit();
}

