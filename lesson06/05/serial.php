<?php
/**
 * Created by PhpStorm.
 * User: mzh
 * Date: 11/6/16
 * Time: 2:15 PM
 */
header("Content-type: text/html; charset=utf-8");
echo "<title>对象串行化</title>";

$arr = array("name"=>"zhangsan", "age"=>18, "sex"=>"女");
$str = serialize($arr);
var_dump($str);
echo "<br />";

$arr1 = unserialize($str);
var_dump($arr1);

