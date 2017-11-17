<?php
date_default_timezone_set('PRC');
header("Content-Type: text/html; charset=UTF-8");

if (!file_exists(dirname(dirname(__DIR__)) . '/install.lock')) {
    include 'html.php';
} else {
    include 'tips.php';
}


