<?php
define('APP_DEBUG','true');
define('CSS_URL','/Public/css/');
define('IMG_URL','/Public/images/');
define('JS_URL','/Public/js/');
define('FONT_URL','/Public/font/');
if (isset($_SERVER['TP_ENV'])) {
    $tp_env = strtolower(trim($_SERVER['TP_ENV']));
    define('APP_STATUS', $tp_env);
}
define('ADMIN_CSS_URL','/Admin/Public/css/');
define('ADMIN_IMG_URL','/Admin/Public/images/');
define('ADMIN_JS_URL','/Admin/Public/js/');
define('SITE_URL','http://book.luoqiaoqiao.com/');
require_once '../ThinkPHP/ThinkPHP.php';
