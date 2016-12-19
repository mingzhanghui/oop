<?php
/**
 * Created by PhpStorm.
 * User: mzh
 * Date: 11/6/16
 * Time: 2:27 PM
 */
header("Content-type: text/html; charset:utf-8");
echo "<title>反串行化</title>";

include ("./demo.class.php");

$str = file_get_contents("./data.txt");

// 可以把串行化的结果进行反串行化操作
$d = unserialize($str);

var_dump($d->age);