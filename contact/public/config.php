<?php
/**
 * Created by PhpStorm.
 * User: mzh
 * Date: 11/9/16
 * Time: 1:18 PM
 */
// 项目根目录
$domain = "http://localhost/oop/contact";
setcookie("domain", $domain, time()+1800);

// 数据库驱动
$pdo_dsn = "mysql:dbname=mydatabase; host=127.0.0.1; charset=utf8";
//　数据库用户名
$pdo_username = "root";
//  数据库密码
$pdo_password = "root";

// 设置时区
date_default_timezone_set('Asia/Shanghai');

